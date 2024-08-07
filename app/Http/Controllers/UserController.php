<?

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

use Spatie\Permission\Models\Role;
use App\Notifications\NewUserNotification; // Import the notification class use
use Illuminate\Foundation\Validation\ValidatesRequests;

class UserController extends Controller
{
    use ValidatesRequests;
    public function index(Request $request)
    {
        $users = User::paginate(10); // Default to 10 per page if not specified
        return view("users.index", compact("users"));
    }
    public function create()
    {
        $roles = Role::pluck("name", "name")->all();
        return view("users.create", compact("roles"));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            'gender' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        // Send the notification
        $user->notify(new NewUserNotification($user));

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles()->pluck('name', 'name')->all();
        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        // Log or debug here
        Log::info('Update method called');

        // Validate incoming request data
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            // Add other fields as needed
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Log the request data
        Log::info('Request data: ', $request->all());

        // Update user attributes
        $user->name = $request->input('name');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        // Add other fields as needed

        // Save the updated user
        $user->save();

        // Log success message
        Log::info('User updated successfully');

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }

    public function notifications(Request $request)
    {
        $notifications = $request->user()->notifications;

        return view('notifications.index', compact('notifications'));
    }
}