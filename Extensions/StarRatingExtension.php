<?php

namespace blackknight467\StarRatingBundle\Extensions;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig\Extension\AbstractExtension;
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
        return $this->container->get('templating')->render(
            'StarRatingBundle:Display:ratingDisplay.html.twig',
            array(
                'stars' => $number,
                'max' => $max,
                'starSize' => $starSize
            )
        );
    }

    public function getName()
    {
        return 'star_rating_extension';
    }
}
