<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use App\Entity\Mensaje;
use App\Entity\Banda;
use App\Entity\Modo;
use App\Form\MensajeType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;

class miController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/home', name: 'app_home')]
    public function home(  Request $request):response
    {
        return $this->render('main/home.html.twig');
    }

    #[Route('/verificaMensajes', name: 'app_verifica_mensajes')]
    public function verifica(  Request $request):response
    {
        return $this->render('juez/verificaMensajes.html.twig');
    }


    #[Route('/enviaMensajes', name: 'app_envia_mensajes')]
    public function envia(  
        Request $request,
        EntityManagerInterface $entityManager,
        PaginatorInterface $paginator,
    ): Response    
    {
        $mensajes = $this->doctrine
            ->getRepository(Mensaje::class)
            ->findAll();



        $mensajes = $paginator->paginate($mensajes, $request->query->getInt('page', 1),6);


    
        $bandas= $this->doctrine
            ->getRepository(Banda::class)
            ->findAll();

        $modos= $this->doctrine
            ->getRepository(Modo::class)
            ->findAll();

        $mensaje = new mensaje();
        $form = $this->createForm(MensajeType::class, $mensaje);
        $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                // encode the plain password
                $modo=$form->get('id_modo')->getData();
                $banda=$form->get('id_banda')->getData();
                $distancia=$form->get('distancia')->getData();
                $juez=$form->get('juez')->getData();
                $participante=$this->getUser();
                // dd($idModo);
                $fechaHoy= date('d-m-Y H:i:s');
                // $userSession = $this->get('security.context')->getToken()->getUser();
                // dd($fechaHoy);
                // dd($form->get('id_banda')->getData());
                $max=$form->get('id_banda')->getData()->getfrecuenciaMax();
                $min=$form->get('id_banda')->getData()->getfrecuenciaMin();

                if($distancia<$max && $distancia>$min){
                    $mensaje = new Mensaje();
                    $mensaje->setidModo($modo);
                    $mensaje->setidBanda($banda);
                    $mensaje->setDistancia($distancia);
                    $mensaje->setJuez($juez);
                    $mensaje->setParticipante($participante);
                    $mensaje->setFecha($fechaHoy);
                    $mensaje->setValidado(false); 
                    $entityManager->persist($mensaje);
                    $entityManager->flush(); 
                }
                else{
                    $error="Distancia debe estar entre su rango";
                }

                

                // do anything else you need here, like send an email
    
                $mensajes = $this->doctrine
                ->getRepository(Mensaje::class)
                ->findAll();
                $mensajes = $paginator->paginate($mensajes, $request->query->getInt('page', 1),6);

                return $this->render('user/pintaMensajes.html.twig',[
                    'mensajes'=>$mensajes,
                    'modos'=>$modos,
                    'bandas'=>$bandas,
                    'form_mensaje' => $form->createView(),
                    'error' => $error,
                ]);
            }

        return $this->render('user/pintaMensajes.html.twig',[
            'mensajes'=>$mensajes,
            'modos'=>$modos,
            'bandas'=>$bandas,
            'form_mensaje' => $form->createView(),
            'error' => "",
        ]);
    }

}
