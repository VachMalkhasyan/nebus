<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Building;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use OpenApi\Annotations as OA;


/**
  @OA\Info(title="Company API", version="1.0")
 */
class CompanyController extends Controller
{
    /**
     * @OA\Get(
     *     path="/companies/building/{buildingId}",
     *     summary="Вы можете получить компании по здании",
     *     description="Возвращает список компаний, расположенных в определенном здании.",
     *     @OA\Parameter(
     *         name="buildingId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список компаний в указанном здании.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Company"))
     *     ),
     * )
     */
    public function getCompaniesByBuilding($buildingId)
    {
        $building = Building::with('company.phones','company.categories','company.buildings')->findOrFail($buildingId);
        return response()->json($building->company);
    }


    /**
     * @OA\Get(
     *     path="/companies/category/{categoryId}",
     *     summary="Вы можете получить компании по категориям",
     *     description="Возвращает список компаний в определенной категории.",
     *     @OA\Parameter(
     *         name="categoryId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список компаний в указанной категории.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Company"))
     *     ),
     * )
     */
    public function getCompaniesByCategory($categoryId)
    {
        $category = Category::with('companies')->findOrFail($categoryId);
        return response()->json($category->companies);
    }

    /**
     * @OA\Get(
     *     path="/companies/location",
     *     summary="Вы можете получить компании по местоположению и радиусу",
     *     description="Возвращает список компаний, расположенных в пределах заданного радиуса или прямоугольной области относительно заданной точки на карте.",
     *     @OA\Parameter(
     *         name="latitude",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="number", format="float")
     *     ),
     *     @OA\Parameter(
     *         name="longitude",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="number", format="float")
     *     ),
     *     @OA\Parameter(
     *         name="radius",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список компаний по местоположению.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Company"))
     *     ),
     * )
     */
    public function getCompaniesByLocation(Request $request)
    {
        $data = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'required|numeric',
        ]);

        $latitude = $data['latitude'];
        $longitude = $data['longitude'];
        $radius = $data['radius'];

        $companies = Building::selectRaw(
            "id, address, coordinates,
            ST_DistanceSphere(
                ST_SetSRID(ST_MakePoint(CAST(? AS NUMERIC), CAST(? AS NUMERIC)), 4326),
                ST_SetSRID(ST_MakePoint(CAST(coordinates->>'longitude' AS NUMERIC),
                                       CAST(coordinates->>'latitude' AS NUMERIC)), 4326)
            ) AS distance",
            [$longitude, $latitude]
        )
            ->having('distance', '<', $radius)
            ->with('company')
            ->get();

        return response()->json($companies);
    }




    /**
     * @OA\Get(
     *     path="/companies/{id}",
     *     summary="Вы можете получить компанию по ID",
     *     description="Возвращает информацию о компании по ID.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Информация о компании.",
     *         @OA\JsonContent(ref="#/components/schemas/Company")
     *     ),
     * )
     */
    public function getCompanyById($id)
    {
        $company = Company::with(['buildings', 'phones', 'categories'])->findOrFail($id);
        return response()->json($company);
    }

    /**
     * @OA\Get(
     *     path="/companies/search/activity",
     *     summary="Поиск компаний по виду деятельности",
     *     description="Ищет компании по типу деятельности, возвращая все компании, соответствующие данному виду деятельности, и соответствующие подкатегории.",
     *     @OA\Parameter(
     *         name="activity",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список компаний, соответствующих запросу по виду деятельности.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Company"))
     *     ),
     * )
     */
    public function searchCompaniesByActivity(Request $request)
    {
        $activityType = $request->activity;

        $categories = Category::where('name', 'like', '%' . $activityType . '%')
            ->orWhereHas('children.children', function ($query) use ($activityType) {
                $query->where('name', 'like', '%' . $activityType . '%');
            })
            ->pluck('id');

        $companies = Company::with(['phones', 'categories', 'buildings'])
            ->whereHas('categories', function ($query) use ($categories) {
                $query->whereIn('categories.id', $categories);
            })
            ->get();

        return response()->json($companies);
    }


    /**
     * @OA\Get(
     *     path="/companies/search/name",
     *     summary="Поиск компаний по названию",
     *     description="Ищет компании по названию.",
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список компаний, соответствующих запросу по названию.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Company"))
     *     ),
     * )
     */
    public function searchCompaniesByName(Request $request)
    {
        $companyName = $request->name;

        $companies = Company::with(['phones', 'categories', 'buildings'])
            ->where('name', 'like', '%' . $companyName . '%')
            ->get();

        return response()->json($companies);
    }

}
