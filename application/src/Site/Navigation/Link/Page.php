<?php
namespace Omeka\Site\Navigation\Link;

use Omeka\Entity\Site;
use Omeka\Api\Representation\SiteRepresentation;

class Page extends AbstractLink
{
    public function getLabel()
    {
        return 'Page';
    }

    public function getForm(array $data)
    {
        return '<label>Label <input type="text" data-name="label" value="' . $data['label'] . '"></label>';
    }

    public function toZend(array $data, Site $site)
    {
        $sitePage = $site->getPages()->get($data['id']);
        return [
            'label' => $data['label'],
            'route' => 'site/page',
            'params' => [
                'site-slug' => $site->getSlug(),
                'page-slug' => $sitePage->getSlug(),
            ],
        ];
    }

    public function toJstree(array $data, SiteRepresentation $site)
    {
        $sitePage = $site->pages()[$data['id']];
        $label = isset($data['label']) ? $data['label'] : $sitePage->title();
        return [
            'label' => $label,
            'id' => $sitePage->id(),
        ];
    }
}