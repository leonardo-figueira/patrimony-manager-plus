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
     * @Route("/pmp/conta-patrimonial/novo", name="pmp_contaPatrimonial_novo")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function salvarAction(Request $request)
    {
        $manipulador = $this->get('pmp.conta_patrimonial_edicao');

        $entity = new PMPEntity\ContaPatrimonial();
        $entity->setNome($request->request->get('contaPatrimonialNome'));

        $manipulador->salvar($entity);

        return $this->redirectToRoute('posvenda_parametrizacao_cid_novo');
    }



}