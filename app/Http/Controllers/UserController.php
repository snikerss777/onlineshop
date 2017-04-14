<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller {



	public function __construct(Request $request, User $user)
   	{
       $this->request = $request;
       $this->user = $user;
  	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::all();

		return $users;
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{	
		$user = User::findOrFail($id);

		return view('user.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::findOrFail($id);

		return view('user.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{					
		$rules = $this->user->edit_rules;
		$user = User::findOrFail($id);

		$password = $request->input( 'password' );
		if (empty( $password)) {
			$request->merge( array( 'password' => $user->password ) );
			$request->merge( array( 'password_confirmation' => $user->password ) );

			$this->validate($request, $rules);
		}
		else{
			$this->validate($request, $rules);
			$request->merge( array( 'password' => bcrypt($password) ) );
		}

		if(empty($request->input('bank_account_number'))){
			$request->merge( array( 'bank_account_number' => null ) );
		}

		if(empty($request->input('avenue'))){
			$request->merge( array( 'avenue' => null ) );
		}

		if(empty($request->input('apartment_number'))){
			$request->merge( array( 'apartment_number' => null ) );
		}
	
		$user->update($request->all());

		return redirect("/")->with('positive_message', 'Nowe dane zostały zapisane.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::findOrFail($id);
	}

	public function authUser()
	{
		return redirect("auth/login")->with('message', 'Aby dokonać zamówienia musisz być zalogowany. Jeśli nie masz jeszcze konta, <a href="auth/register"> zarejestruj się </a>');
	}
}
