<?php namespace App\Pagination;

use Illuminate\Contracts\Pagination\Paginator as PaginatorContract;
use Illuminate\Contracts\Pagination\Presenter as PresenterContract;
use Illuminate\Pagination\UrlWindow;
use Illuminate\Pagination\UrlWindowPresenterTrait;

class Presenter implements PresenterContract
{
	use UrlWindowPresenterTrait;
	
	protected $paginator;
	protected $window;
	
	public function __construct(PaginatorContract $paginator, UrlWindow $window = null)
	{
		$this->paginator = $paginator;
		$this->window = is_null($window) ? UrlWindow::make($paginator) : $window->get();
	}
	
	protected function getPreviousButton($text = '&larr;')
	{
		if ($this->paginator->currentPage() <= 1) {
			return '';
		}
		
		$url = $this->paginator->url($this->paginator->currentPage() - 1);
		
		return $this->getPageLinkWrapper($url, $text, 'previous_page');
	}
	
	protected function getNextButton($text = '&rarr;')
	{
		if (!$this->paginator->hasMorePages()) {
			return '';
		}
		
		$url = $this->paginator->url($this->paginator->currentPage() + 1);
		
		return $this->getPageLinkWrapper($url, $text, 'next_page');
	}
	
	public function hasPages()
	{
		return $this->paginator->hasPages();
	}
	
	public function render()
	{
		if (!$this->hasPages()) {
			return '';
		}
		
		return sprintf(
			'<ul class="pagination">%s %s %s</ul>',
			$this->getPreviousButton(),
			$this->getLinks(),
			$this->getNextButton()
		);
	}
	
	protected function getAvailablePageWrapper($url, $page, $id = '')
	{
		$id = $id ? sprintf(' id="%s"', $id) : '';
		
		return sprintf('<li><a class="js-pjax" href="%s"%s>%s</a></li>', htmlentities($url), $id, $page);
	}
	
	protected function getDisabledTextWrapper($text)
	{
		return '<li class="disabled"><span>' . $text . '</span></li>';
	}
	
	protected function getActivePageWrapper($text)
	{
		return '<li class="active"><span>' . $text . '</span></li>';
	}
	
	protected function getDots()
	{
		return $this->getDisabledTextWrapper('...');
	}
}
