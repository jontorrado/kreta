<?php

/*
 * This file is part of the Kreta package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Kreta\Bundle\MediaBundle\EventSubscriber;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use Kreta\Component\Media\Model\Interfaces\MediaInterface;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class MediaUrlSubscriber.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class MediaUrlSubscriber implements EventSubscriberInterface
{
    /**
     * The object media attribute name, by default is null.
     *
     * @var string
     */
    protected $attribute;

    /**
     * The fully qualified class namespace.
     *
     * @var string
     */
    protected $class;

    /**
     * The media type; required to build the directory path.
     *
     * @var string
     */
    protected $mediaType;

    /**
     * The router.
     *
     * @var \Symfony\Bundle\FrameworkBundle\Routing\Router
     */
    protected $router;

    /**
     * Constructor.
     *
     * @param \Symfony\Bundle\FrameworkBundle\Routing\Router $router    The router instance
     * @param string                                         $class     The fully qualified class namespace
     * @param string                                         $mediaType Media type; required to build the dir path
     * @param null|string                                    $attribute Object media attribute name
     */
    public function __construct(Router $router, $class, $mediaType, $attribute = null)
    {
        $this->router = $router;
        $this->class = $class;
        $this->mediaType = $mediaType;
        $this->attribute = $attribute;
        if ($this->attribute === null) {
            $this->attribute = $this->mediaType;
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            ['event' => 'serializer.pre_serialize', 'method' => 'onChangeObjectMedia'],
        ];
    }

    /**
     * Event that updates the media attribute of the object,
     * turning the name of the media into the absolute url.
     *
     * @param \JMS\Serializer\EventDispatcher\ObjectEvent $event The event
     */
    public function onChangeObjectMedia(ObjectEvent $event)
    {
        $object = $event->getObject();
        if ($object instanceof $this->class) {
            $method = 'get' . ucfirst($this->attribute);
            $media = $object->$method();

            if ($media instanceof MediaInterface && strpos($media->getName(), 'http://') === false) {
                $method = 'set' . ucfirst($this->attribute);
                $object->$method(
                    $media->setName(
                        $this->router->generate(
                            'kreta_media_' . $this->mediaType, ['name' => $media->getName()],
                            UrlGeneratorInterface::ABSOLUTE_URL
                        )
                    )
                );
            }
        }
    }
}
