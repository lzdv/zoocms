<?php

/*
 * This file is part of the Sonata project.
 *
 * (c) Sonata Project <https://github.com/sonata-project/SonataClassificationBundle/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\ClassificationBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CategoryAdmin extends Admin
{
    protected $formOptions = array(
        'cascade_validation' => true
    );

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General', array('class' => 'col-md-6'))
                ->add('name')
                ->add('description', 'textarea', array('required' => false))
            ->end()
            ->with('Options', array('class' => 'col-md-6'))
                ->add('enabled')
                ->add('position', 'integer', array('required' => false, 'data' => 0))
            ->end()
        ;
  
        if ($this->getSubject()->getParent() !== null || $this->getSubject()->getId() === null) {
            $formMapper
                ->add('parent', 'sonata_category_selector', array(
                    'category'      => $this->getSubject() ?: null,
                    'model_manager' => $this->getModelManager(),
                    'class'         => $this->getClass(),
                    'required'      => false/*,
                    'context'       => $this->getSubject()->getContext()*/
                ));
        }
/**/
        if (interface_exists('Sonata\MediaBundle\Model\MediaInterface')) {
            $formMapper
                ->with('General')
                    ->add('media', 'sonata_type_model_list',
                        array('required' => false),
                        array(
                            'link_parameters' => array(
                                'provider' => 'sonata.media.provider.image',
                                'context'  => 'sonata_category',
                            )
                        )
                    )
                ->end();
        }
//*/
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('enabled')
            ->add('parent')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('slug')
            ->add('description')
            ->add('enabled', null, array('editable' => true))
            ->add('position')
            ->add('parent')
        ;
    }
    
    /**
     * {@inheritdoc}
     *
    public function getPersistentParameters()
    {
        $parameters = array(
            'context'      => '',
            'hide_context' => (int)$this->getRequest()->get('hide_context', 0)
        );
        if ($this->getSubject()) {
            $parameters['context'] = $this->getSubject()->getContext() ? $this->getSubject()->getContext()->getId() : '';
            return $parameters;
        }
        if ($this->hasRequest()) {
            $parameters['context'] = $this->getRequest()->get('context');
            return $parameters;
        }
        return $parameters;
    }//*/
}
