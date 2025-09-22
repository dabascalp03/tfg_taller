@if(Auth::check())
    <div class="d-flex align-items-center gap-2" style="font-size:1rem;">
        <span class="text-light fw-semibold" style="font-size:1.05rem;">
            <i class="fas fa-user-circle me-1" style="color:#ff8000; font-size:1.1em;"></i>
            {{ Auth::user()->nombre }}
        </span>
        <a href="{{ route('dashvehiculos') }}"
           class="btn fw-bold px-3 py-1 rounded-3 shadow-sm"
           style="color: #ff8000; background: #fff; border: 2px solid #ff8000; font-size:0.99rem; box-shadow: 0 2px 8px rgba(255,128,0,0.07); transition: background 0.18s, color 0.18s, border 0.18s;">
            <i class="fas fa-car-side me-1"></i> Área Personal
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline"
              onsubmit="setTimeout(() => window.location.href = '/', 500);">
            @csrf
            <button type="submit" class="btn fw-bold px-3 py-1 rounded-3 shadow-sm"
                    style="color: #fff; background: #ff8000; border: 2px solid #ff8000; font-size:0.99rem; box-shadow: 0 2px 8px rgba(255,128,0,0.07); transition: background 0.18s, color 0.18s, border 0.18s;">
                <i class="fas fa-sign-out-alt me-1" style="color:#fff; font-size:1em;"></i>
            </button>
        </form>
    </div>
@else
    <div class="d-flex align-items-center gap-2" style="font-size:0.97rem;">
        <a href="{{ route('login') }}"
           class="btn fw-bold px-3 py-1 rounded-3 shadow-sm"
           style="color:#ff8000; border:2px solid #ff8000; background:#fff; font-size:0.99rem; box-shadow: 0 2px 8px rgba(255,128,0,0.07); transition:background 0.18s, color 0.18s, border 0.18s;">
            <i class="fas fa-sign-in-alt me-1"></i> Iniciar Sesión
        </a>
        <a href="{{ route('register') }}"
           class="btn fw-bold px-3 py-1 rounded-3 shadow-sm"
           style="background: #ff8000; color: #fff; border: 2px solid #ff8000; font-size:0.99rem; box-shadow: 0 2px 8px rgba(255,128,0,0.07); transition: background 0.18s, color 0.18s, border 0.18s;">
            <i class="fas fa-user-plus me-1"></i> Registrarse
        </a>
    </div>
@endif
