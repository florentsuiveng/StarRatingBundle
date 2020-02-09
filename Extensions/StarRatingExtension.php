<?php

namespace blackknight467\StarRatingBundle\Extensions;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Twig\Extension\AbstractExtension;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Twig\TwigFilter;

class StarRatingExtension extends AbstractExtension
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFilters()
    {
        return array(
            new TwigFilter('rating', array($this, 'rating'), array('is_safe' => array('all'))),
        );
    }

    public function rating($number, $max = 5, $starSize = "")
    {
        $filesystemLoader = new FilesystemLoader(dirname(__DIR__, 1).'/Resources/views/%name%');
        $templating = new PhpEngine(new TemplateNameParser(), $filesystemLoader);

        return $templating->render(
            'Display/ratingDisplay.php',
            array(
                'stars' => $number,
                'max' => $max,
                'starSize' => $starSize
            )
        );

//        return $this->container->get('templating')->render(
//            'StarRatingBundle:Display:ratingDisplay.html.twig',
//            array(
//                'stars' => $number,
//                'max' => $max,
//                'starSize' => $starSize
//            )
//        );
    }

    public function getName()
    {
        return 'star_rating_extension';
    }
}
