@if(session('success'))
    <div style="color:green; margin-bottom:10px;">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 10px; border-radius: 5px;">
        <ul style="margin:0; padding-left:20px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/register" style="max-width: 400px; margin: auto; padding: 30px; background: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
    @csrf

    <h2 style="text-align:center; margin-bottom:20px;">Register</h2>

    <input type="text" name="name" placeholder="Name" required style="width:100%; padding:10px; margin-bottom:15px; border-radius:5px; border:1px solid #ccc;">
    
    <input type="email" name="email" placeholder="Email" required style="width:100%; padding:10px; margin-bottom:15px; border-radius:5px; border:1px solid #ccc;">
    
    <input type="password" name="password" placeholder="Password" required style="width:100%; padding:10px; margin-bottom:15px; border-radius:5px; border:1px solid #ccc;">
    
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required style="width:100%; padding:10px; margin-bottom:15px; border-radius:5px; border:1px solid #ccc;">
    
    <select name="role" style="width:100%; padding:10px; margin-bottom:20px; border-radius:5px; border:1px solid #ccc;">
        <option value="resident" selected>Resident</option>
        <option value="admin">Admin</option>
    </select>
    
    <button type="submit" style="width:100%; padding:10px; background-color:#007bff; color:white; border:none; border-radius:5px; cursor:pointer;">
        Register
    </button>

    <p style="text-align:center; margin-top:15px;">
        Already have an account? <a href="{{ route('login') }}">Login</a>
    </p>
</form>
