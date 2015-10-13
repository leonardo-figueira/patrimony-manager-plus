<?php
/**
 * Created by PhpStorm.
 * User: leonardo
 * Date: 30/09/2015
 * Time: 19:47
 */

namespace PMPBundle\Controller;

use PMPBundle\Entity as PMPEntity;
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

            If ($_POST['txtId']) {

                $id = $_POST['txtId'];

                $service = $this->get('pmp.conta_patrimonial_rules');

                $contasPatrimoniais = $service->buscarPorId($id);

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

        $manipulador->salvar($entity);

        return $this->redirectToRoute('contaPatrimonial_index');
    }

    /**
     * @Route("/cadastro", name="pmp_contaPatrimonial_cadastro")
     * Template()
     */
    public function cadastrarAction()
    {
        return $this->render('PMPBundle:ContaPatrimonial:cadastrar.html.twig');
    }


}