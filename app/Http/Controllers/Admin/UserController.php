<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    private string $table;
    protected $userService;
        /**
     * userServiceInterface constructor.
     *
     * @param UserServiceInterface $userService
     */

    public function __construct(
        UserServiceInterface $userService
    )
    {   
        $this -> userService = $userService;
        $this -> table = (new User())->getTable();

        View::share('title', ucwords($this->table));
        View::share('table', $this->table);
    }

    public function index(Request $request)
    {
        $user=$this->userService->getUser(auth()->user()->id);
        return view("admin.$this->table.index", compact(
            'user',
            ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $request = $request->all();
        $this->userService->changePassword($request);
        return response()->json([
            'status'  => config('constants.CODE_STATUS.SUCCESS'),
            'title'   => 'User',
            'message' => 'Change password successfully',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->userService->store($request);
            DB::commit();
                return response()->json([
                    'status'  => config('constants.CODE_STATUS.SUCCESS'),
                    'title'   => 'User',
                    'message' => 'Change information successfully',
                ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status'  => config('constants.CODE_STATUS.FAIL'),
                'title'   => 'User',
                'message' => 'Change information FAIL',
            ]);
        }
    }
}
