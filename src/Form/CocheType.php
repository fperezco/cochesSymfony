<?php


namespace App\Form;


use App\Entity\Coche;


use App\Entity\Concesionario;
use App\Entity\Marca;
use App\Entity\Modelo;
use App\Repository\ConcesionarioRepository;
use App\Repository\MarcaRepository;
use App\Repository\ModeloRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CocheType extends AbstractType
{
    /**
     * @var MarcaRepository
     */
    private $marcaRepository;
    /**
     * @var ModeloRepository
     */
    private $modeloRepository;
    /**
     * @var ConcesionarioRepository
     */
    private $concesionarioRepository;

    public function __construct(MarcaRepository $marcaRepository,ModeloRepository $modeloRepository,ConcesionarioRepository $concesionarioRepository)
    {
        $this->marcaRepository = $marcaRepository;
        $this->modeloRepository = $modeloRepository;
        $this->concesionarioRepository = $concesionarioRepository;
    }

    // como seran los campos de este formulario
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add concesionario marca y modelo dinamico
            ->add('anyo', DateType::class)
            ->add('matricula', TextType::class)
            ->add('precio', NumberType::class)
            ->add('vendido', CheckboxType::class)
            ->add('save', SubmitType::class);

        $builder->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmit'));
        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Coche::class,
            ]
        );
    }


    function onPreSetData(FormEvent $event) {
        $coche = $event->getData();
        $form = $event->getForm();

        // When you create a new person, the City is always empty
        $marca = $coche->getMarca() ? $coche->getMarca() : null;
        $this->addElementMarcaModel($form, $marca);

        $concesionario = $coche->getConcesionario() ? $coche->getConcesionario() : null;
        $this->addElementConcesionario($form, $concesionario);
    }

    function onPreSubmit(FormEvent $event) {
        $form = $event->getForm();
        $data = $event->getData();

        // Search for selected City and convert it into an Entity
        $marca = $this->marcaRepository->find($data['marca']);
        $concesionario = $this->concesionarioRepository->find($data['concesionario']);


        $this->addElementMarcaModel($form, $marca);
        $this->addElementConcesionario($form, $concesionario);

    }

    protected function addElementMarcaModel(FormInterface $form, Marca $marca = null) {
        //Siempre existe una marca que puede venir o no a null
        $form->add('marca', EntityType::class, array(
            'required' => true,
            'data' => $marca,
            'choice_value' => 'id',
            'choice_label' => 'nombre',
            'placeholder' => 'Select a MarcaCity...',
            'class' => Marca::class
        ));

        // Modelos vacio a menos que ya haya seleccionado una marca ( Edit View )
        $modelos = array();

        // Si existe una marca => obtenemos los modelos asociados
        if ($marca) {
            // Fetch Neighborhoods of the City if there's a selected city
            $modelos = $marca->getModelos();
        }

        // Add the Neighborhoods field with the properly data
        $form->add('modelo', EntityType::class, array(
            'required' => true,
            'placeholder' => 'Select a CityMod first ...',
            'class' => Modelo::class,
            'choice_value' => 'id',
            'choice_label' => 'nombre',
            'choices' => $modelos
        ));
    }

    protected function addElementConcesionario(FormInterface $form, Concesionario $concesionario = null) {
        // 4. Add the province element
        $form->add('concesionario', EntityType::class, array(
            'required' => true,
            'data' => $concesionario,
            'choice_value' => 'id',
            'choice_label' => 'direccion',
            'placeholder' => 'Select a ConceCity...',
            'class' => Concesionario::class
        ));
    }

}