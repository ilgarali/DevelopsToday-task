<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    /**
     * @param Post $post
     * @return AnonymousResourceCollection
     */
    public function index(Post $post): AnonymousResourceCollection
    {
        return CommentResource::collection($post->comments()->paginate(20));
    }

    /**
     * @param CommentRequest $request
     * @param Post $post
     * @return CommentResource
     */
    public function store(CommentRequest $request, Post $post): CommentResource
    {
        $comment = $post->comments()->create($request->validated());
        return new CommentResource($comment);
    }

    /**
     * @param Post $post
     * @param Comment $comment
     * @return CommentResource
     */
    public function show(Post $post, Comment $comment): CommentResource
    {
        return new CommentResource($comment);
    }

    /**
     * @param CommentRequest $request
     * @param Post $post
     * @param Comment $comment
     * @return CommentResource
     */
    public function update(CommentRequest $request, Post $post, Comment $comment): CommentResource
    {
        $comment->update($request->validated());
        return new CommentResource($comment);
    }

    /**
     * @param Post $post
     * @param Comment $comment
     * @return JsonResponse
     */
    public function destroy(Post $post, Comment $comment): JsonResponse
    {
        $comment->delete();
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
