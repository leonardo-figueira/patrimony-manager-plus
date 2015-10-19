<?php
/**
 * Created by PhpStorm.
 * User: leonardo
 * Date: 30/09/2015
 * Time: 19:47
 */

namespace PMPBundle\Controller;

use PMPBundle\Entity as PMPEntity;
use PMPBundle\Services as PMPService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/conta-patrimonial")
 */
class ContaPatrimonialController extends Controller
{
    /**
     * @Route("/", name="contaPatrimonial_index")
     * @Template()
     */
    public function indexAction(){

        $contasPatrimoniais = null;

        If($_POST) {


            If ($_POST['txtId'] !='' and $_POST['txtNome'] == '') {

                $id = $_POST['txtId'];
                $nome = '';
                /* @var PMPService\ContaPatrimonial\ContaPatrimonialBusca  */
                $service = $this->get('pmp.conta_patrimonial_busca');
                $contasPatrimoniais = $service->buscarPorId($id,$nome);

            }

            If ($_POST['txtId'] == '' and $_POST['txtNome'] != '') {
                $nome = $_POST['txtNome'];
                $id = '';
                /* @var PMPService\ContaPatrimonial\ContaPatrimonialBusca  */
                $service = $this->get('pmp.conta_patrimonial_busca');
                $contasPatrimoniais = $service->buscarPorId($id,$nome);

            }
        }

        return array('contasPatrimoniais' => $contasPatrimoniais);
    }

    /**
     * @Route("/salvar", name="contaPatrimonial_salvar")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function salvarAction(Request $request)
    {

        $manipulador = $this->get('pmp.conta_patrimonial_edicao');

        $entity = new PMPEntity\ContaPatrimonial();
        $entity->setNome($request->request->get('contaPatrimonialNome'));
        $entity->setStatus('1');

        $manipulador->salvar($entity);

        $this->addFlash('success', 'Conta Patrimonial '. $request->request->get('contaPatrimonialNome') .' Cadastrada Com sucesso');

        return $this->redirectToRoute('contaPatrimonial_index');
    }


    /**
     * @Route("/editar", name="contaPatrimonial_editar")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editarAction(Request $request)
    {

        $service = $this->get('pmp.conta_patrimonial_busca');
        $entity = $service->find($request->request->get('contaPatrimonialId'));

        $manipulador = $this->get('pmp.conta_patrimonial_edicao');

        $entity->setNome($request->request->get('contaPatrimonialNome'));

        $manipulador->editar($entity);

        $this->addFlash('success', 'Conta Patrimonial Editada Com sucesso');

        return $this->redirectToRoute('contaPatrimonial_index');
    }

    /**
     * @Route("/cadastro", name="contaPatrimonial_cadastro")
     * Template()
     */
    public function cadastrarAction()
    {
        return $this->render('PMPBundle:ContaPatrimonial:cadastrar.html.twig');
    }

    /**
     * @Route("/editar-conta/{id}", name="contaPatrimonial_editarContaPatrimonial")
     * Template()
     */
    public function editarContaPatrimonialAction($id)
    {
        $service = $this->get('pmp.conta_patrimonial_busca');
        $entity = $service->find($id);

        return $this->render('PMPBundle:ContaPatrimonial:editar.html.twig',array('entity'=> $entity));
    }

    /**
     * @Route("/listar-contas-patrimoniais", name="contaPatrimonial_listar")
     * @Template()
     */
    public function listarAction(){

        $service = $this->get('pmp.usuario_busca');
        $lista = $service->buscarTodos();

        return array('contasPatrimoniais' => $lista);
    }


}