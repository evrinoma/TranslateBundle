<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\TranslateBundle\Controller;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Evrinoma\DtoBundle\Factory\FactoryDtoInterface;
use Evrinoma\TranslateBundle\Dto\TranslateApiDtoInterface;
use Evrinoma\TranslateBundle\Exception\TranslateCannotBeSavedException;
use Evrinoma\TranslateBundle\Exception\TranslateInvalidException;
use Evrinoma\TranslateBundle\Exception\TranslateNotFoundException;
use Evrinoma\TranslateBundle\Facade\Translate\FacadeInterface;
use Evrinoma\TranslateBundle\Serializer\GroupInterface;
use Evrinoma\UtilsBundle\Controller\AbstractWrappedApiController;
use Evrinoma\UtilsBundle\Controller\ApiControllerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class TranslateApiController extends AbstractWrappedApiController implements ApiControllerInterface
{
    private string $dtoClass;

    private ?Request $request;

    private FactoryDtoInterface $factoryDto;

    private FacadeInterface $facade;

    public function __construct(
        SerializerInterface $serializer,
        RequestStack $requestStack,
        FactoryDtoInterface $factoryDto,
        FacadeInterface $facade,
        string $dtoClass
    ) {
        parent::__construct($serializer);
        $this->request = $requestStack->getCurrentRequest();
        $this->factoryDto = $factoryDto;
        $this->dtoClass = $dtoClass;
        $this->facade = $facade;
    }

    /**
     * @Rest\Post("/api/translate/create", options={"expose": true}, name="api_translate_create")
     * @OA\Post(
     *     tags={"translate"},
     *     description="the method perform create translate",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\TranslateBundle\Dto\TranslateApiDto",
     *                     "code_src": "ru",
     *                     "code_dst": "en",
     *                     "text_src": "Привет мир!",
     *                     "text_dst": "Hello world!",
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\TranslateBundle\Dto\TranslateApiDto"),
     *                 @OA\Property(property="code_src", type="string"),
     *                 @OA\Property(property="code_dst", type="string"),
     *                 @OA\Property(property="text_src", type="string"),
     *                 @OA\Property(property="text_dst", type="string"),
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Create translate")
     *
     * @return JsonResponse
     */
    public function postAction(): JsonResponse
    {
        /** @var TranslateApiDtoInterface $translateApiDto */
        $translateApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $this->setStatusCreated();

        $json = [];
        $error = [];
        $group = GroupInterface::API_POST_TRANSLATE;

        try {
            $this->facade->post($translateApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Create translate', $json, $error);
    }

    /**
     * @Rest\Put("/api/translate/save", options={"expose": true}, name="api_translate_save")
     * @OA\Put(
     *     tags={"translate"},
     *     description="the method perform save translate for current entity",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\TranslateBundle\Dto\TranslateApiDto",
     *                     "id": "48",
     *                     "code_src": "ru",
     *                     "code_dst": "en",
     *                     "text_src": "Привет мир!",
     *                     "text_dst": "Hello world!",
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\TranslateBundle\Dto\TranslateApiDto"),
     *                 @OA\Property(property="id", type="string"),
     *                 @OA\Property(property="code_src", type="string"),
     *                 @OA\Property(property="code_dst", type="string"),
     *                 @OA\Property(property="text_src", type="string"),
     *                 @OA\Property(property="text_dst", type="string"),
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Save translate")
     *
     * @return JsonResponse
     */
    public function putAction(): JsonResponse
    {
        /** @var TranslateApiDtoInterface $translateApiDto */
        $translateApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_PUT_TRANSLATE;

        try {
            $this->facade->put($translateApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Save translate', $json, $error);
    }

    /**
     * @Rest\Delete("/api/translate/delete", options={"expose": true}, name="api_translate_delete")
     * @OA\Delete(
     *     tags={"translate"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\TranslateBundle\Dto\TranslateApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="3",
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Delete translate")
     *
     * @return JsonResponse
     */
    public function deleteAction(): JsonResponse
    {
        /** @var TranslateApiDtoInterface $translateApiDto */
        $translateApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $this->setStatusAccepted();

        $json = [];
        $error = [];

        try {
            $this->facade->delete($translateApiDto, '', $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->JsonResponse('Delete translate', $json, $error);
    }

    /**
     * @Rest\Get("/api/translate/criteria", options={"expose": true}, name="api_translate_criteria")
     * @OA\Get(
     *     tags={"translate"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\TranslateBundle\Dto\TranslateApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         @OA\Schema(
     *             type="string",
     *             default="48"
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Current Language",
     *         in="query",
     *         name="code_src",
     *         @OA\Schema(
     *             type="string",
     *             default="en"
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Target Language",
     *         in="query",
     *         name="code_dst",
     *         @OA\Schema(
     *             type="string",
     *             default="ru"
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Text To Translate",
     *         in="query",
     *         name="text_src",
     *         @OA\Schema(
     *             type="string",
     *             default="Hello world"
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Return translate")
     *
     * @return JsonResponse
     */
    public function criteriaAction(): JsonResponse
    {
        /** @var TranslateApiDtoInterface $translateApiDto */
        $translateApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_CRITERIA_TRANSLATE;

        try {
            $this->facade->criteria($translateApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Get translate', $json, $error);
    }

    /**
     * @Rest\Get("/api/translate", options={"expose": true}, name="api_translate")
     * @OA\Get(
     *     tags={"translate"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\TranslateBundle\Dto\TranslateApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="3",
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Return translate")
     *
     * @return JsonResponse
     */
    public function getAction(): JsonResponse
    {
        /** @var TranslateApiDtoInterface $translateApiDto */
        $translateApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_GET_TRANSLATE;

        try {
            $this->facade->get($translateApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Get translate', $json, $error);
    }

    /**
     * @param \Exception $e
     *
     * @return array
     */
    public function setRestStatus(\Exception $e): array
    {
        switch (true) {
            case $e instanceof TranslateCannotBeSavedException:
                $this->setStatusNotImplemented();
                break;
            case $e instanceof UniqueConstraintViolationException:
                $this->setStatusConflict();
                break;
            case $e instanceof TranslateNotFoundException:
                $this->setStatusNotFound();
                break;
            case $e instanceof TranslateInvalidException:
                $this->setStatusUnprocessableEntity();
                break;
            default:
                $this->setStatusBadRequest();
        }

        return [$e->getMessage()];
    }
}
