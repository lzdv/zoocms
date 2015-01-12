<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // SYMFONY STANDARD EDITION
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new JMS\AopBundle\JMSAopBundle(),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            
            // DOCTRINE
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            
            // KNP HELPER BUNDLES
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new Knp\Bundle\MarkdownBundle\KnpMarkdownBundle(),
            
            // USER
            new FOS\UserBundle\FOSUserBundle(),
            new Sonata\UserBundle\SonataUserBundle('FOSUserBundle'),
            
            // MEDIA
            new Sonata\MediaBundle\SonataMediaBundle(),
            
            // BACKEND
            new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
            new Sonata\AdminBundle\SonataAdminBundle(),
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
            
            // SERIALIZATION
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new JMS\SerializerBundle\JMSSerializerBundle($this),
            
            // BOOTSTRAP
            new Sonata\jQueryBundle\SonatajQueryBundle(),
            new Mopa\Bundle\BootstrapBundle\MopaBootstrapBundle(),
            
            // SONATA CORE & HELPER BUNDLES
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\FormatterBundle\SonataFormatterBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            
            // E-COMMERCE
            
//            new Sonata\BasketBundle\SonataBasketBundle(),
//            new Application\Sonata\BasketBundle\ApplicationSonataBasketBundle(),
//            new Sonata\CustomerBundle\SonataCustomerBundle(),
//            new Application\Sonata\CustomerBundle\ApplicationSonataCustomerBundle(),
//            new Sonata\DeliveryBundle\SonataDeliveryBundle(),
//            new Application\Sonata\DeliveryBundle\ApplicationSonataDeliveryBundle(),
//            new Sonata\InvoiceBundle\SonataInvoiceBundle(),
//            new Application\Sonata\InvoiceBundle\ApplicationSonataInvoiceBundle(),
//            new Sonata\OrderBundle\SonataOrderBundle(),
//            new Application\Sonata\OrderBundle\ApplicationSonataOrderBundle(),
//            new Sonata\PaymentBundle\SonataPaymentBundle(),
//            new Application\Sonata\PaymentBundle\ApplicationSonataPaymentBundle(),

            new Sonata\ProductBundle\SonataProductBundle(),
            new Application\Sonata\ProductBundle\ApplicationSonataProductBundle(),
            new Sonata\ClassificationBundle\SonataClassificationBundle(),
            new Application\Sonata\ClassificationBundle\ApplicationSonataClassificationBundle(),
//            new Sonata\PriceBundle\SonataPriceBundle(),
//            new JMS\SerializerBundle\JMSSerializerBundle($this),
//            new FOS\CommentBundle\FOSCommentBundle(),
//            new Sonata\CommentBundle\SonataCommentBundle(),
//            new Application\Sonata\CommentBundle\ApplicationSonataCommentBundle(),
            
            
            // SONATA NEWS
            new Sonata\NewsBundle\SonataNewsBundle(),
            new Application\Sonata\NewsBundle\ApplicationSonataNewsBundle(),

            // CMF Integration
            new Symfony\Cmf\Bundle\RoutingBundle\CmfRoutingBundle(),
            
            // these are the bundles for the CMS
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Ibrows\Bundle\SonataAdminAnnotationBundle\IbrowsSonataAdminAnnotationBundle(),
            new Lexik\Bundle\TranslationBundle\LexikTranslationBundle(),
            new Ibrows\SonataTranslationBundle\IbrowsSonataTranslationBundle(),
            
            // INIT CMS
            new Networking\InitCmsBundle\NetworkingInitCmsBundle(),
            new Application\Networking\InitCmsBundle\ApplicationNetworkingInitCmsBundle(),
            new Lzdv\InitCmsExtensionBundle\LzdvInitCmsExtensionBundle(),
            
            // CONTENT SHORTCODES
            new drinky78\Bundle\ShortcodeBundle\ShortcodeBundle(),
            new Lzdv\InitCmsProductBundle\LzdvInitCmsProductBundle(),
            new Lzdv\InitCmsMapBundle\LzdvInitCmsMapBundle(),
            
            // INITCMS MAP BUNDLE
            new Oh\GoogleMapFormTypeBundle\OhGoogleMapFormTypeBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }
        
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config/config_' . $this->getEnvironment() . '.yml');
    }
}
