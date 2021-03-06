<?php

namespace App\Controller;

use App\Entity\Member;
use App\Form\MemberType;
use App\Repository\MemberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class MemberApiController extends AbstractController
{
    //顯示全部資料api
    /**
     * @Route("/", methods="GET")
     */
    public function apiindex(MemberRepository $memberRepository): Response
    {
      $data = $memberRepository->findAll();
      return $this->json(["200"=>"資料載入成功","data"=>$data]);

    }
    //新增一筆資料 api
    /**
     * @Route("/new", methods="POST")
     */
    public function new(Request $request): Response
    {
        $data = $request->getContent();
        parse_str($data,$data_arr);

        $member = new Member();
        $form = $this->createForm(MemberType::class, $member);
        $form->submit($data_arr);
        $doctrine =  $this->getDoctrine()->getManager();
        $doctrine->persist($member);
        $doctrine->flush();

        return $this->json(["200"=>"資料新增成功","data"=>$member]);
    }

    //查看單一筆資料api
    /**
     * @Route("/{id}", methods="GET")
     */
    public function show($id)
    {
        $member = $this->getDoctrine()->getRepository(Member::class)->find($id);

       if(!$member) {
              return $this->json(["404"=>"操作錯誤，查無此聯絡人資料"] );
              }
              return $this->json(["200"=>"資料載入成功","data"=>$member]);
    }
    
    //修改資料的api
    /**
     * @Route("/edit/{id}", name="update",methods="PUT")
     */
    public function update($id,Request $request)
    {
      $data =$request->request->all();
      $doctrine = $this->getDoctrine();
      $member = $doctrine->getRepository(Member::class)->find($id);
    //   dd($member);

      if($request->request->has("name"))
        $member->setName($data["name"]);
      if($request->request->has("ename"))
        $member->setEname($data["ename"]);
      if($request->request->has("phone"))
        $member->setPhone($data["phone"]);
      if($request->request->has("email"))
        $member->setEmail($data["email"]);
      if($request->request->has("sex"))
        $member->setSex($data["sex"]);
      if($request->request->has("city"))
        $member->setCity($data["city"]);
      if($request->request->has("township"))
        $member->setTownship($data["township"]);
      if($request->request->has("postcode"))
        $member->setPostcode($data["postcode"]);
      if($request->request->has("address"))
        $member->setAddress($data["address"]);
      if($request->request->has("notes"))
        $member->setNotes($data["notes"]);

        $manager = $doctrine->getManager();
        $manager->flush();
        
        return $this->json(["200"=>"資料修改成功","data"=>$member]);    
    }

    //刪除的api
    /**
     * @Route("/delete/{id}", methods="DELETE")
     */
    public function delete(Request $request, Member $member): Response
    {
        $this->isCsrfTokenValid('delete'.$member->getId(), $request->request->get('_token'));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($member);
        $entityManager->flush();
        return $this->json(["200" => "資料刪除成功"]);
    }
}
