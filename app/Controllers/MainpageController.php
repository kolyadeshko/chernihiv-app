<?php


namespace App\Controllers;


class MainpageController extends \App\Controller
{
    public function getMainpage()
    {
        $popularPublications = $this
            ->models['publications']
            ->getPublications(
                [
                    'orderby' => 'views',
                    'ordering' => 'desc',
                    "limit" => '4'
                ])['publications'];
        return $this->renderer->render(
            $this->request,
            "mainpage",
            [
                "popularPublications" => $popularPublications
            ]
        );
    }
}