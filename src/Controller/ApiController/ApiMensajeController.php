<?php
 
namespace App\Controller\ApiController;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Mensaje;
use Doctrine\Persistence\ManagerRegistry;
 

#[Route('/api',name:"api_")]
class ApiMensajeController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine) {}



    #[Route('/mensaje',name:"mensaje_index", methods:"GET")]
    public function index(): Response
    {
        $mensajes = $this->doctrine
                         ->getRepository(Mensaje::class)
                         ->findAll();
 
        $arrayMensajes = [];

        if(!$mensajes){
            return $this->json("No hay mensajes", 404);
        }
        
        foreach ($mensajes as $mensaje) {
            $arrayMensajes[] = [
                'id' => $mensaje->getId(),
                'ancho' => $mensaje->getAncho(),
                'alto' => $mensaje->getAlto(),
                'x' => $mensaje->getX(),
                'y' => $mensaje->getY(),
                'imagen' => $mensaje->getImagen(),
            ];
        }
 
 
        return $this->json($arrayMensajes);
    }

    #[Route('/mensaje/{id}',name:"mensajes_show", methods:"GET")]
    public function show(int $id): Response
    {
        $mensaje = $this->doctrine
            ->getRepository(Mensaje::class)
            ->find($id);
 
        if (!$mensaje) {
 
            return $this->json(['No hay mensajes por esa id: ' . $id, 'codigo:404 '], 404);
        }
 
        $arrayMensajes[] = [
            'id' => $mensaje->getId(),
            'ancho' => $mensaje->getAncho(),
            'alto' => $mensaje->getAlto(),
            'x' => $mensaje->getX(),
            'y' => $mensaje->getY(),
            'imagen' => $mensaje->getImagen(),

        ];
         
        return $this->json($arrayMensajes);
    }


    #[Route('/mensaje/{id}',name:"mensaje_show2", methods:"PUT")]
    public function edit(Request $request, int $id): Response
    {
        $entityManager = $this->doctrine->getManager();
        $mensaje = $entityManager->getRepository(Mensaje::class)->find($id);
        //var_dump($producto);
        if (!$mensaje) {
            return $this->json(['No hay mensajes por esa id: ' . $id, 'codigo:404 '], 404);
        }
 
        $mensaje->setAncho($request->request->get('ancho'));
        $mensaje->setAlto($request->request->get('alto'));
        $mensaje->setX($request->request->get('x'));
        $mensaje->setY($request->request->get('y'));
        $mensaje->setImagen($request->request->get('imagen'));
        
        $entityManager->persist($mensaje);
        $entityManager->flush();

        $arrayMensajes[] = [
            'id' => $mensaje->getId(),
            'ancho' => $mensaje->getAncho(),
            'alto' => $mensaje->getAlto(),
            'x' => $mensaje->getX(),
            'y' => $mensaje->getY(),
            'imagen' => $mensaje->getImagen(),
        ];
         
        return $this->json(['Guardada la mensaje con id: '. $id ,'codigo: 201',$arrayMensajes],201);
    }
 


    #[Route('/mensaje',name:"mensaje_new", methods:"POST")]
    public function new(Request $request): Response
    {
        $entityManager = $this->doctrine->getManager();
 
        $mensaje = new Mensaje();
        $mensaje->setAncho($request->request->get('ancho'));
        $mensaje->setAlto($request->request->get('alto'));
        $mensaje->setX($request->request->get('x'));
        $mensaje->setY($request->request->get('y'));
        $mensaje->setImagen($request->request->get('imagen'));
 
        $entityManager->persist($mensaje);
        $entityManager->flush();
 
        return $this->json(['Creada la nueva mensaje con id ' . $mensaje->getId(), 'codigo: 201'], 201);
    }

    #[Route('/mensaje/{id}',name:"mensaje_delete", methods:"DELETE")]
    public function delete(int $id): Response
    {
        $entityManager = $this->doctrine->getManager();
        $mensaje = $entityManager->getRepository(Mensaje::class)->find($id);
 
        if (!$mensaje) {
            return $this->json(['No hay mensajes por esa id: ' . $id, 'codigo: 404 '], 404);
        }
 
        $entityManager->remove($mensaje);
        $entityManager->flush();
 
        return $this->json(['Borrada correctamente la mensaje con id ' . $id,'codigo: 200']);
    }
 
       
 
 
 
}