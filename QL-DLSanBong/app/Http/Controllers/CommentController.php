<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Responses\APIResponse;
use App\Services\CommentService;
use Illuminate\Http\Request;
use function Sodium\add;

class CommentController extends Controller
{
    protected $commentService;
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $data["user_id"] = auth()->user()->id;
        return APIResponse::success($this->commentService->createComment($data));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $userCurrent = auth()->user()->id;
        $role = auth()->user()->is_admin;
        return APIResponse::success($this->commentService->delete($id,$userCurrent,$role));

    }
}
