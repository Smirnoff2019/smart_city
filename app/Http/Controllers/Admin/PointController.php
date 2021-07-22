<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Models\Tag;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $paginator = Point::latest()->paginate(5);

        return view('Admin.points.index', ['paginator' => $paginator])
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('Admin.points.create', [
            'point' => [],
            'tags' => Tag::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Point $point
     * @return RedirectResponse
     */
    public function store(Request $request, Point $point)
    {
        $point = Point::create($request->all());

        if ($request->input('tags')) :
            $point->tags()->attach($request->input('tags'));
        endif;

        return redirect()->route('Admin.points.index')
            ->with('success','Точка успешно создана.');
    }

    /**
     * Display the specified resource.
     *
     * @param Point $point
     * @return Factory|View
     */
    public function show(Point $point)
    {
        return view('Admin.points.show', ['point' => $point]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Point $point
     * @return Factory|View
     */
    public function edit(Point $point)
    {
        //$point = DB::table('points')->find($id);
        return view('Admin.points.edit', [
            'point' => $point,
            'tags' => Tag::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Point $point
     * @return RedirectResponse
     */
    public function update(Request $request, Point $point)
    {
        $point->update($request->all());
        //tags
//        $point->tags()->detach();
//        if ($request->input('tags')) :
//            $point->tags()->attach($request->input('tags'));
//        endif;

        if ($point) {
            return redirect()->route('Admin.points.index')
                ->with('success','Данные точки успешно обновлены.');
        }else{
            return back()
                ->withErrors(['msg' => "Ошибка сохранения."])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Point $point
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Point $point)
    {
        //tags
        //$point->tags()->detach();
        //point
        $point->delete();

        return $point ? redirect()
            ->route('Admin.points.index')
            ->with('success', 'Точка успешно удалена.') : back()->withErrors(['msg' => 'Ошибка удаления.']);
    }
}
