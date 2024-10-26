<?php

namespace classes;

class Menu
{
    private $menu = [
        0 => [
           'class' => "nav-item",
           'class-a' => "nav-link click-scroll",
           'href' => "#top",
           'content' => "Home"
        ],
        1 => [
            'class' => "nav-item",
            'class-a' => "nav-link click-scroll",
            'href' => "#section_2",
            'content' => "About",
        ],
        2 => [
            'class' => "nav-item",
            'class-a' => "nav-link click-scroll",
            'href' => "#section_3",
            'content' => "Causes",
        ],
        3 => [
            'class' => "nav-item",
            'class-a' => "nav-link click-scroll",
            'href' => "#section_4",
            'content' => "Volunteer",
        ],
        4 => [
            'class' => "nav-item dropdown",
            'class-a' => "nav-link click-scroll dropdown-toggle",
            'href' => "#section_5",
            'id' => "navbarLightDropdownMenuLink",
            'role' => "button",
            'data-bs-toggle' => "dropdown",
            'aria-expanded' => "false",
            'content' => "News",
            'class-ul' => "dropdown-menu dropdown-menu-light",
            'aria-labelledby' => "navbarLightDropdownMenuLink",
            "items" => [
                0 => [
                    'class' => "dropdown-item",
                    'href' => "news.php",
                    'content' => "News Listing",
                ],
                1 => [
                    'class' => "dropdown-item",
                    'href' => "news-detail.php",
                    'content' => "News Detail",
                ],
            ]
        ],
        5 => [
            'class' => "nav-item ms-3",
            'class-a' => "nav-link custom-btn custom-border-btn btn",
            'href' => "donate.php",
            'content' => "Donate",
        ],
    ];


    public function getMenu($type = "header"): string
    {
        $serverUrl = $_SERVER['REQUEST_URI'];
        $urlParts = explode("/", $serverUrl);
        $newUrlParts = [];
        foreach ($urlParts as $part) {
            if(!empty($part)) {
                $newUrlParts[] = $part;
            }
        }
        $numberOfUrlParts = count($newUrlParts);
        if($numberOfUrlParts === 1) {
            $useOriginal = true;
        } elseif ($numberOfUrlParts === 2 && $newUrlParts[1] === 'index.php') {
            $useOriginal = true;
        } else {
            $useOriginal = false;
        }

        $html = "";

        if($type === "header") {
            foreach ($this->menu as $menu) {
                if(isset($menu['items'])) {
                    $html .= '<li class="'.$menu['class'].'">
                                <a class="'.$menu['class-a'].'" 
                                href="'.$menu['href'].'" 
                                id="'.$menu['id'].'" 
                                role="'.$menu['role'].'" 
                                data-bs-toggle="'.$menu['data-bs-toggle'].'" 
                                aria-expanded="'.$menu['aria-expanded'].'">'.$menu['content'].'</a>

                    <ul class="'.$menu['class-ul'].'" aria-labelledby="'.$menu['aria-labelledby'].'">';
                    foreach ($menu['items'] as $item) {
                        $html .= '<li>
                                    <a 
                                    class="'.$item['class'].'" 
                                    href="'.$item['href'].'">'.$item['content'].'
                                    </a>
                                  </li>';
                    }
                    $html .= '</ul></li>';
                } else {
                    if(!$useOriginal) {
                        if($menu['href'] === $newUrlParts[1]) {
                            $link = $menu['href'];
                        } else {
                            $link = "index.php";
                        }
                        $html .= '<li class="'.$menu['class'].'">
                                <a class="'.$menu['class-a'].'" 
                                href="'.$link.'">'.$menu['content'].'</a>
                              </li>';
                    } else {
                        $html .= '<li class="'.$menu['class'].'">
                                <a class="'.$menu['class-a'].'" 
                                href="'.$menu['href'].'">'.$menu['content'].'</a>
                              </li>';
                    }

                }
            }
        }

        return $html;
    }
}