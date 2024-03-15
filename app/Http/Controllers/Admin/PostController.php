<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\PostServiceInterface;
use App\Services\Contracts\TagServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class PostController extends Controller
{
    private object $model;
    private string $table;
    
    protected $postService;
    protected $tagService;
    protected $categoryService;

    /**
     * postServiceInterface constructor.
     *
     * @param PostServiceInterface $postService
     */
    public function __construct(
        PostServiceInterface $postService,
        TagServiceInterface $tagService,
        CategoryServiceInterface $categoryService

    )
    {   
        $this->table =(new Post())->getTable();
        $this->postService = $postService;
        $this->tagService = $tagService;
        $this->categoryService = $categoryService;

        View::share('title', ucwords($this->table));
        View::share('table', $this->table);
    }

    public function index(Request $request)
    {
        $data = @$request->all();
        $filter = [
            'search' => @$data['search'],
            'status' => @$data['status'],
        ];
        // Get Post book
        $posts = $this->postService->index($filter);

        if ((@$data['search'] || @$data['status'])) {        
            return view("admin.$this->table.table", [
                'posts' => $posts,
                'filter' => @$filter,
            ]);
        }
        
        return view("admin.$this->table.index",[
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posts=$this->model->select('id','title')->get();
        $categories = $this->categoryService->getAll();
        $tags = $this->tagService->getAll();
        return view("admin.$this->table.create",compact(
            'posts',
            'tags',
            'categories',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->postService->store($request);
            DB::commit();
                return response()->json([
                    'status'  => config('constants.CODE_STATUS.SUCCESS'),
                    'title'   => 'Post',
                    'message' => 'Create new post successfully',
                ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status'  => config('constants.CODE_STATUS.FAIL'),
                'title'   => 'Post',
                'message' => 'Create new post FAIL',
            ]);
        }
        
    }

    public function uploadImage(Request $request) {
        return $this->postService->uploadImage($request);
    }
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        return $this->postService->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->postService->show($id);
        $posts = $this->postService->getAll()->pluck('id','title');
        $categories = $this->categoryService->getAll();
        $tags = $this->tagService->getAll();
        
        return view("admin.$this->table.edit",compact(
            'posts',
            'post',
            'tags',
            'categories',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update( $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        // $this->model->find($post)->delete();
        // return redirect()->back();
    }

    public function updateStatus($id)
    {
        $post = $this->postService->updateStatus($id);
        if ($post) {
            return response()->json([
                'status'  => config('constants.CODE_STATUS.SUCCESS'),
                'title'   => 'Post',
                'message' => 'Update post status successfully',
            ]);
        }
        return response()->json([
            'status'  => config('constants.CODE_STATUS.FAIL'),
            'title'   => 'Post',
            'message' => 'Update post status fail',
        ]);
    }
}
