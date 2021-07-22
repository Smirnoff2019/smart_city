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

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $paginator = Tag::latest()->paginate(5);

        return view('Admin.tags.index', ['paginator' => $paginator])
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('Admin.tags.create', [
            'tag' => [],
            'points' => Point::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Tag $tag
     * @return RedirectResponse
     */
    public function store(Request $request, Tag $tag)
    {
        $tag = Tag::create($request->all());

        if ($request->input('points')) :
            $tag->points()->attach($request->input('points'))->save();
        endif;

        return redirect()->route('Admin.tags.index')
            ->with('success','Ориентир успешно создана.');
    }

    /**
     * Display the specified resource.
     *
     * @param Tag $tag
     * @return Factory|View
     */
    public function show(Tag $tag)
    {
        return view('Admin.tags.show', ['tag' => $tag]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tag $tag
     * @return Factory|View
     */
    public function edit(Tag $tag)
    {
        return view('Admin.tags.edit', [
            'tag' => $tag,
            'points' => Point::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Tag $tag
     * @return RedirectResponse
     */
    public function update(Request $request, Tag $tag)
    {
        $tag->update($request->all());
        //points
        $tag->points()->detach();
        if ($request->input('points')) :
            $tag->points()->attach($request->input('points'));
        endif;

        if ($tag) {
            return redirect()->route('Admin.tags.index')
                ->with('success','Данные ориентиры успешно обновлены.');
        }else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения."])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tag $tag
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Tag $tag)
    {
        //points
        $tag->points()->detach();
        //tag
        $tag->delete();

        return $tag ? redirect()
            ->route('Admin.tags.index')
            ->with('success', 'Ориентир успешно удален.') : back()->withErrors(['msg' => 'Ошибка удаления.']);
    }
}
