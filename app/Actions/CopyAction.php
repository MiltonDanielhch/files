<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class CopyAction extends AbstractAction
{
    public function getTitle()
    {
        return 'Copiar link';
    }

    public function getIcon()
    {
        return 'fa fa-clone';
    }

    public function getPolicy()
    {
        return 'read';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-dark pull-right btn-copy-link',
            'data-url' => route('voyager.files.show', $this->data->id)
        ];
    }

    public function getDefaultRoute()
    {
        return url('#');
    }
    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'files';
    }
}