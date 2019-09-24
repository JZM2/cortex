<?php

namespace App\Controller;

use App\Classes\Report;
use App\Entity\Card;
use App\Entity\Customer;
use App\Form\CustomerFormType;
use App\Form\FindCustomerFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class IndexController
 * @package App\Controller
 */
class IndexController extends AbstractController
{
    /**
     * display the customer registration form
     * @Route("/", name="cust_registration", )
     */
    public function registrationCustomer(): Response
    {

        $customer = new Customer();

        $form = $this->createForm(CustomerFormType::class, $customer, [
            'action' => $this->generateUrl('cust_save')
        ]);

        return $this->render('customer/registration.html.twig', [
            'customerForm' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/Customer/save", name="cust_save", )
     */
    public function saveCustomer(Request $request): Response
    {
        /** @var Customer $customer */
        $customer = new Customer();

        $form = $this->createForm(CustomerFormType::class, $customer);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $customer = $form->getData();
                $customer->setRegistration(new \DateTime('now'));

                $em = $this->getDoctrine()->getManager();

                /** @var Customer $cust_exists */
                $cust_exists = $em->getRepository(Customer::class)->findOneBy(["email" => $customer->getEmail()]);

                if (!$cust_exists) {
                    $cust_exists = $customer;
                }

                /** @var Card $card */
                $card = $this->getDoctrine()->getRepository(Card::class)->find($customer->getIdc());

                if (!$card) {
                    $this->addFlash('success', 'Registrace nemohla být provedena. Číslo věrnostní karty není platné!');

                    return $this->redirectToRoute('cust_registration');
                }

                $cust_exists->addCard($card);

                $em->persist($cust_exists);
                $em->flush();

                $this->addFlash('success', 'Registrace proběhla v pořádku, děkujeme.');
                return $this->redirectToRoute('cust_registration');
            } catch (\Exception $chyba) {
                $this->addFlash('success', 'Registrace nebyla provedena! ' . $chyba->getMessage());

                return $this->render('customer/registration.html.twig', [
                    'customerForm' => $form->createView(),
                ]);
            }
        }

        $this->addFlash('warning', 'Registrace nebyla provedena! Formulář není validní.');

        return $this->redirectToRoute('cust_registration');
    }

    /**
     * display form for find
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/Customer/find", name="cust_find", )
     */
    public function findCustomerForm(Request $request): Response
    {
        /** @var array $findCustomers */
        $findCustomers = null;

        $form = $this->createForm(FindCustomerFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $data = $form->getData();
                $em = $this->getDoctrine()->getManager();

                $query = $em->getRepository(Customer::class)->createQueryBuilder('c');

                if ($data['name'] != null) {
                    $query
                        ->andWhere('c.name like :name')
                        ->setParameter('name', $data['name']);
                } else
                    $data['name'] = "";

                if ($data['surname'] != null) {
                    $query
                        ->andWhere('c.surname like :surname')
                        ->setParameter('surname', $data['surname']);
                }

                if ($data['idc'] != null) {
                    $query
                        ->innerJoin('c.card', 'u', 'WITH', 'u.id = :idc')
                        ->setParameter('idc', $data['idc']);
                }

                $findCustomers = $query->getQuery()->getResult();

                if ($findCustomers)
                    $this->addFlash('success', 'Zákazník nalezen');
                else
                    $this->addFlash('success', 'Zákazník nenalezen');

            } catch (\Exception $chyba) {
                $this->addFlash('success', 'Chyba - ' . $chyba->getCode() . '(soubor:' . $chyba->getFile() . ' ) ' . $chyba->getMessage());
                return $this->render('findCustomer/findCustomer.html.twig', [
                    'customerFindForm' => $form->createView(),
                    'findCustomers' => $findCustomers,
                ]);
            }

        }


        return $this->render('findCustomer/findCustomer.html.twig', [
            'customerFindForm' => $form->createView(),
            'findCustomers' => $findCustomers,
        ]);

    }

    public function findCustomer(Request $request)
    {

    }

    /**
     * @Route("/Report", name="report", )
     */
    public function reportCustomer()
    {
        $report = new Report($this->getDoctrine()->getManager());

        $report->getCntCustomers();

        return $this->render('report/report.html.twig', [
            'cntCustomers' => $report->getCntCustomers(),
            'cntCardAssociated' => $report->getCntCard(),
            'topCustomers' => $report->getTopCustomer(),
        ]);
    }
}