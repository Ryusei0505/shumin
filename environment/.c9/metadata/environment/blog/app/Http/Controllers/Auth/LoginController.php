{"changed":true,"filter":false,"title":"LoginController.php","tooltip":"/blog/app/Http/Controllers/Auth/LoginController.php","value":"<?php\n\nnamespace App\\Http\\Controllers\\Auth;\n\nuse App\\Http\\Controllers\\Controller;\nuse App\\Providers\\RouteServiceProvider;\nuse Illuminate\\Foundation\\Auth\\AuthenticatesUsers;\nuse Socialite;\nuse App\\User;\n\nclass LoginController extends Controller\n{\n    /*\n    |--------------------------------------------------------------------------\n    | Login Controller\n    |--------------------------------------------------------------------------\n    |\n    | This controller handles authenticating users for the application and\n    | redirecting them to your home screen. The controller uses a trait\n    | to conveniently provide its functionality to your applications.\n    |\n    */\n\n    use AuthenticatesUsers;\n\n    /**\n     * Where to redirect users after login.\n     *\n     * @var string\n     */\n    protected $redirectTo = RouteServiceProvider::HOME;\n\n    /**\n     * Create a new controller instance.\n     *\n     * @return void\n     */\n    public function __construct()\n    {\n        $this->middleware('guest')->except('logout');\n    }\n    \n    public function redirectToGoogle()\n    {\n        // Google へのリダイレクト\n        return Socialite::driver('google')->redirect();\n    }\n\n    public function handleGoogleCallback()\n    {\n        // Google 認証後の処理\n        // あとで処理を追加しますが、とりあえず dd() で取得するユーザー情報を確認\n        $gUser = Socialite::driver('google')->stateless()->user();\n        // email が合致するユーザーを取得\n        $user = User::where('email', $gUser->email)->first();\n        // 見つからなければ新しくユーザーを作成\n        if ($user == null) {\n            $user = $this->createUserByGoogle($gUser);\n        }\n        // ログイン処理\n        \\Auth::login($user, true);\n        return redirect('/home');\n    }\n    public function createUserByGoogle($gUser)\n    {\n        $user = User::create([\n            'name'     => $gUser->name,\n            'email'    => $gUser->email,\n            'password' => \\Hash::make(uniqid()),\n        ]);\n        return $user;\n    }\n}\n","undoManager":{"mark":11,"position":12,"stack":[[{"start":{"row":38,"column":5},"end":{"row":39,"column":0},"action":"insert","lines":["",""],"id":1},{"start":{"row":39,"column":0},"end":{"row":39,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":39,"column":4},"end":{"row":51,"column":5},"action":"insert","lines":["public function redirectToGoogle()","    {","        // Google へのリダイレクト","        return Socialite::driver('google')->redirect();","    }","","    public function handleGoogleCallback()","    {","        // Google 認証後の処理","        // あとで処理を追加しますが、とりあえず dd() で取得するユーザー情報を確認","        $gUser = Socialite::driver('google')->stateless()->user();","        dd($gUser);","    }"],"id":2}],[{"start":{"row":39,"column":4},"end":{"row":40,"column":0},"action":"insert","lines":["",""],"id":3},{"start":{"row":40,"column":0},"end":{"row":40,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":6,"column":50},"end":{"row":7,"column":0},"action":"insert","lines":["",""],"id":4}],[{"start":{"row":7,"column":0},"end":{"row":7,"column":13},"action":"insert","lines":["use Socialite"],"id":5}],[{"start":{"row":7,"column":13},"end":{"row":7,"column":14},"action":"insert","lines":[";"],"id":6}],[{"start":{"row":7,"column":14},"end":{"row":8,"column":0},"action":"insert","lines":["",""],"id":7}],[{"start":{"row":8,"column":0},"end":{"row":8,"column":13},"action":"insert","lines":["use App\\User;"],"id":8}],[{"start":{"row":52,"column":8},"end":{"row":53,"column":19},"action":"remove","lines":["$gUser = Socialite::driver('google')->stateless()->user();","        dd($gUser);"],"id":9}],[{"start":{"row":52,"column":8},"end":{"row":61,"column":33},"action":"insert","lines":[" $gUser = Socialite::driver('google')->stateless()->user();","        // email が合致するユーザーを取得","        $user = User::where('email', $gUser->email)->first();","        // 見つからなければ新しくユーザーを作成","        if ($user == null) {","            $user = $this->createUserByGoogle($gUser);","        }","        // ログイン処理","        \\Auth::login($user, true);","        return redirect('/home');"],"id":10}],[{"start":{"row":62,"column":5},"end":{"row":63,"column":0},"action":"insert","lines":["",""],"id":11},{"start":{"row":63,"column":0},"end":{"row":63,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":63,"column":4},"end":{"row":71,"column":5},"action":"insert","lines":["public function createUserByGoogle($gUser)","    {","        $user = User::create([","            'name'     => $gUser->name,","            'email'    => $gUser->email,","            'password' => \\Hash::make(uniqid()),","        ]);","        return $user;","    }"],"id":12}],[{"start":{"row":52,"column":8},"end":{"row":52,"column":9},"action":"remove","lines":[" "],"id":13}]]},"ace":{"folds":[],"scrolltop":585,"scrollleft":0,"selection":{"start":{"row":54,"column":32},"end":{"row":54,"column":32},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":40,"state":"php-start","mode":"ace/mode/php"}},"timestamp":1630755128115}