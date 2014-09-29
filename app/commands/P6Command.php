<?php

use Illuminate\Console\Command;

class P6Command extends Command
{
	protected $name = 'app:p6';
	protected $description = 'Parse vk.com/palnom6';

	public function fire()
	{
		$posts = [];
		$json = json_decode(file_get_contents($this->getUrl()));
		
		/**
		* В первом элементе количество записей,
		* а во втором закрепленный пост
		*/
		for ($i = 2, $len = sizeof($json->response) - 1; $i < $len; $i++) {
			$post = $json->response[$i];
			
			if (!$post->text) {
				continue;
			}
			
			$posts[] = [
				'likes'   => $post->likes->count,
				'reposts' => $post->reposts->count,
				'text'    => $post->text,
			];
		}
		
		rsort($posts);
		
		for ($i = 0; $i < 10; $i++) {
			$this->info(sprintf('#%d. 👍  %d, 📢  %d', $i + 1, $posts[$i]['likes'], $posts[$i]['reposts']));
			$this->comment(wordwrap(str_replace('<br>', "\n", $posts[$i]['text']), 80));
			print "\n";
		}
	}
	
	protected function getUrl($count = 100, $offset = 0)
	{
		return "https://api.vk.com/method/wall.get".
			"?domain=palnom6".
			"&count={$count}".
			"&offset={$offset}";
	}
}
