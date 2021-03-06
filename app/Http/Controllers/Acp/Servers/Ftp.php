<?php namespace App\Http\Controllers\Acp\Servers;

use App\Server;
use Ivacuum\Generic\Controllers\Acp\BaseController;
use League\Flysystem\Adapter;
use League\Flysystem\Filesystem;

class Ftp extends BaseController
{
    protected $fs;

    public function index($id)
    {
        $server = $this->getModel($id);

        $this->initFs($server);

        $dir = request('dir', '/');
        $file = request('file');

        $dirs = $files = [];
        $dirUp = ':';

        if ($dir && $dir != '/') {
            $dirUp = implode('/', explode('/', $dir, -1));
            $dirUp = !$dirUp ? '/' : $dirUp;
        }

        $contents = $this->fs->listContents($dir);

        foreach ($contents as $row) {
            if ($row['type'] == 'dir') {
                $dirs[] = $row;
            } elseif ($row['type'] == 'file') {
                $files[] = $row;
            }
        }

        return view($this->view, [
            'dir' => $dir,
            'dirs' => $dirs,
            'file' => $file,
            'files' => $files,
            'dirUp' => $dirUp,
            'server' => $server,
        ]);
    }

    public function dirPost($id)
    {
        $server = $this->getModel($id);

        $this->initFs($server);

        $data = request()->validate([
            'dir' => 'required',
            'path' => 'required',
        ]);

        $this->fs->createDir("{$data['path']}/{$data['dir']}");

        return redirect("/acp/servers/{$server->id}/ftp?dir={$data['path']}");
    }

    public function filePost($id)
    {
        $server = $this->getModel($id);

        $this->initFs($server);

        $data = request()->validate([
            'file' => 'required',
            'path' => 'required',
        ]);

        $this->fs->write("{$data['path']}/{$data['file']}", '');

        return redirect("/acp/servers/{$server->id}/ftp?dir={$data['path']}");
    }

    public function source($id)
    {
        $server = $this->getModel($id);

        $this->initFs($server);

        $file = request('file');

        $source = $this->fs->read($file);

        $dirUp = dirname($file);
        $dirUp = $dirUp == '.' ? '/' : $dirUp;

        return view($this->view, [
            'file' => $file,
            'dirUp' => $dirUp,
            'server' => $server,
            'source' => $source,
        ]);
    }

    public function sourcePost($id)
    {
        $server = $this->getModel($id);

        $this->initFs($server);

        $data = request()->validate([
            'file' => 'required',
            'source' => '',
        ]);

        $source = str_replace(["\r\n", "\r"], "\n", $data['source']);

        $this->fs->update($data['file'], $source);

        return redirect("/acp/servers/{$server->id}/ftp?dir=" . dirname($data['file']));
    }

    public function uploadPost($id)
    {
        $server = $this->getModel($id);

        $this->initFs($server);

        request()->validate([
            'file' => 'required',
            'path' => 'required',
        ]);

        $path = request('path');
        $file = request()->file('file');
        $stream = fopen($file->getRealPath(), 'r+');
        $this->fs->writeStream($path . '/' . $file->getClientOriginalName(), $stream);
        fclose($stream);

        return redirect("/acp/servers/{$server->id}/ftp?dir={$path}");
    }

    protected function getModel(int $id): ?Server
    {
        return Server::findOrFail($id);
    }

    protected function initFs(Server $server)
    {
        $this->fs = new Filesystem(new Adapter\Ftp([
            'ssl' => false,
            'host' => $server->ftp_host ?: $server->host,
            'port' => 21,
            'root' => $server->ftp_root ?: '/',
            'passive' => true,
            'timeout' => 5,
            'username' => $server->ftp_user,
            'password' => $server->ftp_pass,
        ]));
    }
}
