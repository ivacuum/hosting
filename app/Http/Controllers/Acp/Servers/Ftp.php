<?php namespace App\Http\Controllers\Acp\Servers;

use App\Http\Controllers\Acp\Controller;
use App\Server;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Ftp as FtpAdapter;

class Ftp extends Controller
{
    protected $fs;

    public function index(Server $server)
    {
        $this->initFs($server);

        $dir  = $this->request->input('dir', '/');
        $file = $this->request->input('file');

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

    public function dirPost(Server $server)
    {
        $this->initFs($server);

        $this->validate($this->request, [
            'mail' => 'empty',
            'dir'  => 'required',
            'path' => 'required',
        ]);

        extract($this->request->only('dir', 'path'));

        $this->fs->createDir("{$path}/{$dir}");

        return redirect("/acp/servers/{$server->id}/ftp?dir={$path}");
    }

    public function filePost(Server $server)
    {
        $this->initFs($server);

        $this->validate($this->request, [
            'mail' => 'empty',
            'file' => 'required',
            'path' => 'required',
        ]);

        extract($this->request->only('file', 'path'));

        $this->fs->write("{$path}/{$file}", '');

        return redirect("/acp/servers/{$server->id}/ftp?dir={$path}");
    }

    public function source(Server $server)
    {
        $this->initFs($server);

        $file = $this->request->input('file');

        $source = $this->fs->read($file);

        $dir_up = dirname($file);
        $dir_up = $dir_up == '.' ? '/' : $dir_up;

        return view($this->view, compact('dir_up', 'file', 'server', 'source'));
    }

    public function sourcePost(Server $server)
    {
        $this->initFs($server);

        $this->validate($this->request, [
            'mail' => 'empty',
            'file' => 'required',
        ]);

        extract($this->request->only('file', 'source'));

        $source = str_replace(["\r\n", "\r"], "\n", $source);

        $this->fs->update($file, $source);

        return redirect("/acp/servers/{$server->id}/ftp?dir=" . dirname($file));
    }

    public function uploadPost(Server $server)
    {
        $this->initFs($server);

        $this->validate($this->request, [
            'mail' => 'empty',
            'file' => 'required',
            'path' => 'required',
        ]);

        $path = $this->request->input('path');
        $file = $this->request->file('file');
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
