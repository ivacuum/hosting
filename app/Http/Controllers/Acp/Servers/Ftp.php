<?php namespace App\Http\Controllers\Acp\Servers;

use App\Http\Controllers\Controller;
use App\Server;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Ftp as FtpAdapter;
use Illuminate\Http\Request;

class Ftp extends Controller
{
	protected $fs;

	public function index(Request $request, Server $server)
	{
		$this->initFs($server);

		$dir  = $request->input('dir', '/');
		$file = $request->input('file');

		$dirs = $files = [];
		$dir_up = ':';

		if ($dir && $dir != '/') {
			$dir_up = implode('/', explode('/', $dir, -1));
			$dir_up = !$dir_up ? '/' : $dir_up;
		}

		$contents = $this->fs->listContents($dir);

		foreach ($contents as $row) {
			if ($row['type'] == 'dir') {
				$dirs[] = $row;
			} elseif ($row['type'] == 'file') {
				$files[] = $row;
			}
		}

		return view($this->view, compact('dir', 'dir_up', 'dirs', 'file', 'files', 'server'));
	}

	public function dirPost(Request $request, Server $server)
	{
		$this->initFs($server);

		$this->validate($request, [
			'mail' => 'empty',
			'dir'  => 'required',
			'path' => 'required',
		]);

		extract($request->only('dir', 'path'));

		$this->fs->createDir("{$path}/{$dir}");

		return redirect("/acp/servers/{$server->id}/ftp?dir={$path}");
	}

	public function filePost(Request $request, Server $server)
	{
		$this->initFs($server);

		$this->validate($request, [
			'mail' => 'empty',
			'file' => 'required',
			'path' => 'required',
		]);

		extract($request->only('file', 'path'));

		$this->fs->write("{$path}/{$file}", '');

		return redirect("/acp/servers/{$server->id}/ftp?dir={$path}");
	}

	public function source(Request $request, Server $server)
	{
		$this->initFs($server);

		$file = $request->input('file');

		$source = $this->fs->read($file);

		$dir_up = dirname($file);
		$dir_up = $dir_up == '.' ? '/' : $dir_up;

		return view($this->view, compact('dir_up', 'file', 'server', 'source'));
	}

	public function sourcePost(Request $request, Server $server)
	{
		$this->initFs($server);

		$this->validate($request, [
			'mail' => 'empty',
			'file' => 'required',
		]);

		extract($request->only('file', 'source'));

		$source = str_replace(["\r\n", "\r"], "\n", $source);

		$this->fs->update($file, $source);

		return redirect("/acp/servers/{$server->id}/ftp?dir=" . dirname($file));
	}

	public function uploadPost(Request $request, Server $server)
	{
		$this->initFs($server);

		$this->validate($request, [
			'mail' => 'empty',
			'file' => 'required',
			'path' => 'required',
		]);

		$path = $request->input('path');
		$file = $request->file('file');
		$stream = fopen($file->getRealPath(), 'r+');
		$this->fs->writeStream($path . '/' . $file->getClientOriginalName(), $stream);
		fclose($stream);

		return redirect("/acp/servers/{$server->id}/ftp?dir={$path}");
	}

	protected function initFs(Server $server)
	{
		$this->fs = new Filesystem(new FtpAdapter([
		    'host'     => $server->ftp_host ?: $server->host,
		    'username' => $server->ftp_user,
		    'password' => $server->ftp_pass,
		    'port'     => 21,
		    'root'     => $server->ftp_root ?: '/',
		    'passive'  => true,
		    'ssl'      => false,
		    'timeout'  => 5,
		]));
	}
}
