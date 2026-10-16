<?php
/**
 * Plantilla del Entorno Didáctico de Dinámica - 5.º Año Científico / Biológico
 * Plan 94 / 2.º EMS - Bachillerato Uruguay
 * Versión 2.1.0 - Actualizada con DCLs individuales, laboratorio de frenado dinámico,
 * banco ampliado de ejercicios resueltos y evaluación escrita en papel.
 */
if (!defined('ABSPATH')) exit;
?>

<div id="psd-app-root" class="psd-container">
  
  <!-- Encabezado de la Plataforma -->
  <header class="psd-header no-print">
    <div>
      <span class="psd-badge-sub">Física · 5.º Científico y Biológico · Bachillerato Diversificado (Plan 94 / 2.° EMS)</span>
      <h1>Dinámica: Leyes de Newton y Sistemas de Fuerzas</h1>
      <p>Entorno didáctico interactivo y riguroso para el estudio de la Dinámica en Bachillerato.</p>
    </div>
    
  </header>

  <!-- Pestañas de Navegación de Módulos -->
  <nav class="psd-nav-tabs no-print" aria-label="Módulos de Dinámica">
    <button class="psd-nav-btn active" data-tab="mod1">
      <span class="psd-nav-num">1</span>
      <span>Vectores & DCL</span>
    </button>
    <button class="psd-nav-btn" data-tab="mod2">
      <span class="psd-nav-num">2</span>
      <span>Rozamiento \(\vec{f}_s\) vs \(\vec{f}_k\)</span>
    </button>
    <button class="psd-nav-btn" data-tab="mod3">
      <span class="psd-nav-num">3</span>
      <span>Plano Inclinado</span>
    </button>
    <button class="psd-nav-btn" data-tab="mod4">
      <span class="psd-nav-num">4</span>
      <span>Cuerpos Vinculados</span>
    </button>
    <button class="psd-nav-btn" data-tab="mod5">
      <span class="psd-nav-num">5</span>
      <span>Acople Cinemático</span>
    </button>
    <button class="psd-nav-btn" data-tab="mod6">
      <span class="psd-nav-num">6</span>
      <span>Taller de Problemas</span>
    </button>
    <button class="psd-nav-btn" data-tab="mod7">
      <span class="psd-nav-num">7</span>
      <span>Banco de Resueltos</span>
    </button>
    <button class="psd-nav-btn" data-tab="mod8" style="border-color: #0284c7; color: #0284c7;">
      <span class="psd-nav-num" style="background: #e0f2fe; color: #0369a1;">📝</span>
      <span>Evaluación Escrita</span>
    </button>
  </nav>

  <!-- =========================================================================
       MÓDULO 1: VECTORES EN DINÁMICA Y DIAGRAMA DE CUERPO LIBRE (DCL)
       ========================================================================= -->
  <section id="tab-mod1" class="psd-tab-content active">
    <div class="psd-card">
      <h2>1. Magnitudes Vectoriales y Diagrama de Cuerpo Libre (DCL)</h2>
      
      <p>En el curso de 5.º año, el tratamiento de la Dinámica exige <strong>rigor matemático y formalismo vectorial estricto</strong>. La fuerza no es un simple escalar: es una <strong>magnitud vectorial</strong> \(\vec{F}\) definida por su módulo (\(|\vec{F}|\) o \(F\)), dirección (recta de acción), sentido y punto de aplicación (centro de masa).</p>

      <div class="psd-callout psd-callout-law">
        <strong>Segunda Ley de Newton (Forma Vectorial Fundamental):</strong>
        <div class="psd-formula-box">
          \[ \Sigma \vec{F} = m \vec{a} \]
        </div>
        La aceleración \(\vec{a}\) adquirida por una partícula tiene <strong>exactamente la misma dirección y sentido</strong> que la fuerza resultante \(\Sigma \vec{F}\), y su módulo es directamente proporcional al módulo de dicha fuerza e inversamente proporcional a la masa \(m\).
      </div>

      <h3>Proyección en Ejes Cartesianos Ortogonales</h3>
      <p>Para resolver analíticamente una situación, aislamos el cuerpo mediante un <strong>Diagrama de Cuerpo Libre (DCL)</strong> y proyectamos la ecuación vectorial sobre dos ejes perpendiculares (\(x\) e \(y\)):</p>
      
      <div class="psd-formula-box">
        \[ \Sigma F_x = m a_x \qquad \Sigma F_y = m a_y \]
      </div>
      <p>
        El símbolo \(\Sigma\) (sigma mayúscula, también llamado <strong>sumatoria</strong>) significa <strong>«suma de»</strong>. Entonces \(\Sigma F_x\) se lee «suma de las fuerzas en el eje \(x\)»: es la <strong>fuerza neta</strong> en esa dirección, que se obtiene sumando todas las componentes \(x\) de las fuerzas que actúan sobre el cuerpo, con signo positivo si apuntan en el sentido \(+x\) y negativo si apuntan en sentido contrario. Lo mismo vale para \(\Sigma F_y\) en el eje \(y\).
      </p>

      <div class="psd-callout psd-callout-warning">
        <strong>¡La Normal no siempre es igual al Peso! (\(N \neq P\)):</strong>
        Si sobre el bloque actúa una fuerza \(\vec{F}\) aplicada con un ángulo \(\alpha\), esta posee una componente vertical \(F_y = F \operatorname{sen}\alpha\). Por tanto, en el eje vertical en equilibrio (\(a_y = 0\)):
        \[ \Sigma F_y = N + F \operatorname{sen}\alpha - P = 0 \implies N = m g - F \operatorname{sen}\alpha \]
        ¡La fuerza aplicada alivia el apoyo del cuerpo sobre la superficie, disminuyendo el valor de la fuerza Normal!
      </div>

      <!-- Simulador 1 con SVG amplio y despejado -->
      <h3>Laboratorio Interactivo: DCL con Fuerza Oblicua</h3>
      <p>Ajustá la masa, la fuerza aplicada y el ángulo \(\alpha\) para observar la interacción de los vectores con total claridad:</p>

      <div class="psd-sim-wrap">
        <div class="psd-canvas-wrap">
          <svg id="sim1-svg" viewBox="0 0 540 360"></svg>
        </div>

        <div class="psd-sim-controls">
          <div class="psd-control-row">
            <div class="psd-control-header">
              <span>Masa del bloque (m):</span>
              <span id="sim1-m-val" class="val">8,0 kg</span>
            </div>
            <input type="range" id="sim1-m" min="1" max="25" step="0.5" value="8" />
          </div>

          <div class="psd-control-row">
            <div class="psd-control-header">
              <span>Fuerza aplicada (F):</span>
              <span id="sim1-f-val" class="val">50 N</span>
            </div>
            <input type="range" id="sim1-f" min="0" max="150" step="5" value="50" />
          </div>

          <div class="psd-control-row">
            <div class="psd-control-header">
              <span>Ángulo con la horizontal (α):</span>
              <span id="sim1-angle-val" class="val">30°</span>
            </div>
            <input type="range" id="sim1-angle" min="-45" max="60" step="5" value="30" />
          </div>

          <div class="psd-readout-panel">
            <div class="psd-readout-item">
              <span class="label">Peso P = mg</span>
              <span id="sim1-out-p" class="val">--</span>
            </div>
            <div class="psd-readout-item">
              <span class="label">Comp. Fx (F cos α)</span>
              <span id="sim1-out-fx" class="val">--</span>
            </div>
            <div class="psd-readout-item">
              <span class="label">Comp. Fy (F sen α)</span>
              <span id="sim1-out-fy" class="val">--</span>
            </div>
            <div class="psd-readout-item">
              <span class="label">Normal N</span>
              <span id="sim1-out-n" class="val">--</span>
            </div>
            <div class="psd-readout-item">
              <span class="label">Aceleración ax</span>
              <span id="sim1-out-a" class="val">--</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Microdesafío 1 -->
      <div class="psd-exercise-card">
        <span class="psd-exercise-tag">Microdesafío 1</span>
        <div class="psd-exercise-header">Cálculo de la Normal y Aceleración con Fuerza Oblicua</div>
        <p>Una caja de \(m = 7{,}0\text{ kg}\) se encuentra sobre una mesa horizontal con coeficiente de rozamiento cinético \(\mu_k = 0{,}50\). Se tira de ella mediante una fuerza de \(F = 40\text{ N}\) que forma un ángulo de \(45^\circ\) respecto de la horizontal. (Considerá \(g = 9{,}8\text{ m/s}^2\)).</p>

        <div class="psd-input-group">
          <label for="micro1-n">Módulo de la Normal (N):</label>
          <input type="number" step="any" id="micro1-n" placeholder="ej. 40.3" />
          <span class="psd-unit">N</span>
        </div>

        <div class="psd-input-group">
          <label for="micro1-a">Aceleración adquirida (a):</label>
          <input type="number" step="any" id="micro1-a" placeholder="ej. 1.16" />
          <span class="psd-unit">m/s²</span>
        </div>

        <button id="btn-micro-1" class="psd-btn psd-btn-primary">Verificar Respuesta</button>
        <div id="fb-micro-1" class="psd-feedback"></div>
        <div id="sol-micro-1" class="psd-solution-box" style="display: none;">
          <div class="psd-solution-title">Planteo formal de la solución:</div>
          1. Descomposición: \(F_x = 40 \cos(45^\circ) = 28{,}28\text{ N}\), \(F_y = 40 \operatorname{sen}(45^\circ) = 28{,}28\text{ N}\).<br>
          2. Peso: \(P = m g = 7{,}0 \cdot 9{,}8 = 68{,}6\text{ N}\).<br>
          3. Eje vertical: \(\Sigma F_y = 0 \implies N = P - F_y = 68{,}6 - 28{,}28 = 40{,}32\text{ N}\).<br>
          4. Fricción cinética: \(f_k = \mu_k N = 0{,}50 \cdot 40{,}32 = 20{,}16\text{ N}\).<br>
          5. Eje horizontal: \(\Sigma F_x = F_x - f_k = m a \implies a = \frac{28{,}28 - 20{,}16}{7{,}0} = 1{,}16\text{ m/s}^2\).
        </div>
      </div>

      <div style="margin-top: 1.5rem; text-align: right;">
        <button class="psd-btn psd-btn-primary psd-btn-next-tab" data-next="mod2">Continuar a Rozamiento →</button>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       MÓDULO 2: ROZAMIENTO ESTÁTICO VS. CINÉTICO 
       ========================================================================= -->
  <section id="tab-mod2" class="psd-tab-content">
    <div class="psd-card">
      <h2>2. Fuerzas de Rozamiento: El Umbral Estático (\(\vec{f}_s\)) vs. Cinético (\(\vec{f}_k\))</h2>

      <p>Estudiamos la evolución temporal de la fuerza de rozamiento cuando sobre un cuerpo actúa una fuerza horizontal variable.</p>

      <div class="psd-callout psd-callout-book">
        <strong>Ejemplo 1:</strong>
        Sobre un cuerpo (\(m = 5{,}0\text{ kg}\)) apoyado en una superficie horizontal e inicialmente en reposo, comienza a actuar una fuerza horizontal creciente. Los coeficientes son \(\mu_s = 0{,}40\) y \(\mu_k = 0{,}30\).
        <div class="psd-formula-box">
          \[ N = P = m g = 5{,}0\text{ kg} \cdot 10\text{ m/s}^2 = 50\text{ N} \]
          \[ f_{s,\text{máx}} = \mu_s N = 0{,}40 \cdot 50\text{ N} = 20\text{ N} \]
          \[ f_k = \mu_k N = 0{,}30 \cdot 50\text{ N} = 15\text{ N} \]
        </div>
        El módulo de la fuerza de rozamiento estático aumenta de \(0\text{ N}\) hasta \(20\text{ N}\) acompañando a la fuerza \(F\) aplicada. En el instante en que \(F = 20\text{ N}\), se alcanza la máxima fuerza estática posible y un instante después el cuerpo se desequilibra y comienza a acelerar. A partir de ese momento, la fuerza de rozamiento adquiere el valor constante cinético de \(15\text{ N}\).
      </div>

      <div class="psd-callout psd-callout-concept">
        <strong>Fricción Estática (\(\vec{f}_s\) - Fuerza Reactiva y Variable):</strong>
        <div class="psd-formula-box">
          \[ 0 \le f_s \le f_{s,\text{máx}} = \mu_s N \]
        </div>
        ¡No vale \(\mu_s N\) hasta el umbral de movimiento! Si empujás con \(5\text{ N}\) y no se mueve, \(f_s = 5\text{ N}\).
      </div>

      <!-- Simulador 2 -->
      <h3>Laboratorio Interactivo: Curva de Fricción</h3>
      <p>Ajustá los valores y la fuerza aplicada para ver la transición entre equilibrio estático, punto de ruptura y régimen cinético:</p>

      <div class="psd-sim-wrap">
        <div class="psd-canvas-wrap">
          <svg id="sim2-svg" viewBox="0 0 380 230"></svg>
        </div>

        <div class="psd-sim-controls">
          <div class="psd-control-row">
            <div class="psd-control-header">
              <span>Masa del cuerpo (m):</span>
              <span id="sim2-m-val" class="val">5 kg</span>
            </div>
            <input type="range" id="sim2-m" min="2" max="60" step="1" value="5" />
          </div>

          <div class="psd-control-row">
            <div class="psd-control-header">
              <span>Coeficiente estático (μs):</span>
              <span id="sim2-us-val" class="val">0,40</span>
            </div>
            <input type="range" id="sim2-us" min="0.2" max="0.8" step="0.05" value="0.40" />
          </div>

          <div class="psd-control-row">
            <div class="psd-control-header">
              <span>Coeficiente cinético (μk):</span>
              <span id="sim2-uk-val" class="val">0,30</span>
            </div>
            <input type="range" id="sim2-uk" min="0.1" max="0.6" step="0.05" value="0.30" />
          </div>

          <div class="psd-control-row">
            <div class="psd-control-header">
              <span>Fuerza aplicada (F):</span>
              <span id="sim2-f-val" class="val">18 N</span>
            </div>
            <input type="range" id="sim2-f" min="0" max="250" step="2" value="18" />
          </div>

          <div class="psd-readout-panel">
            <div class="psd-readout-item">
              <span class="label">fs,máx</span>
              <span id="sim2-out-fsmax" class="val">--</span>
            </div>
            <div class="psd-readout-item">
              <span class="label">fk cinético</span>
              <span id="sim2-out-fk" class="val">--</span>
            </div>
            <div class="psd-readout-item">
              <span class="label">f_roz actual</span>
              <span id="sim2-out-froz" class="val">--</span>
            </div>
            <div class="psd-readout-item">
              <span class="label">Aceleración</span>
              <span id="sim2-out-a" class="val">--</span>
            </div>
          </div>
          <div style="font-size: 0.85rem; padding: 0.5rem; background: #e0f2fe; border-radius: 6px; color: #0369a1; font-weight: 600;">
            Estado dinámico: <span id="sim2-out-estado">--</span>
          </div>
        </div>
      </div>

      <!-- Microdesafío 2 -->
      <div class="psd-exercise-card">
        <span class="psd-exercise-tag">Microdesafío 2</span>
        <div class="psd-exercise-header">El Problema del Ropero en Reposo</div>
        <p>Un ropero de masa \(m = 40\text{ kg}\) está apoyado sobre el piso horizontal. El coeficiente de rozamiento estático con el piso es \(\mu_s = 0{,}60\). Se empuja con una fuerza horizontal de \(50\text{ N}\) y no se mueve. Luego se empuja con \(100\text{ N}\) y aún permanece en reposo.</p>

        <div class="psd-input-group">
          <label for="micro2-fs1">Fuerza de rozamiento cuando se empuja con 50 N:</label>
          <input type="number" step="any" id="micro2-fs1" placeholder="ej. 50" />
          <span class="psd-unit">N</span>
        </div>

        <div class="psd-input-group">
          <label for="micro2-fs2">Fuerza de rozamiento cuando se empuja con 100 N:</label>
          <input type="number" step="any" id="micro2-fs2" placeholder="ej. 100" />
          <span class="psd-unit">N</span>
        </div>

        <button id="btn-micro-2" class="psd-btn psd-btn-primary">Verificar Respuesta</button>
        <div id="fb-micro-2" class="psd-feedback"></div>
        <div id="sol-micro-2" class="psd-solution-box" style="display: none;">
          <div class="psd-solution-title">Explicación conceptual física:</div>
          Como el ropero no se mueve en ninguno de los dos casos, está en <strong>equilibrio estático</strong> (\(\Sigma \vec{F} = \vec{0}\)). En la dirección horizontal, la fuerza aplicada y la fuerza de rozamiento estático deben anularse mutuamente: \(F - f_s = 0 \implies f_s = F\).<br>
          Por lo tanto: para \(F = 50\text{ N}\), \(f_s = 50\text{ N}\); y para \(F = 100\text{ N}\), \(f_s = 100\text{ N}\).
        </div>
      </div>

      <div style="margin-top: 1.5rem; text-align: right;">
        <button class="psd-btn psd-btn-primary psd-btn-next-tab" data-next="mod3">Continuar a Plano Inclinado →</button>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       MÓDULO 3: DINÁMICA EN EL PLANO INCLINADO 
       ========================================================================= -->
  <section id="tab-mod3" class="psd-tab-content">
    <div class="psd-card">
      <h2>3. Dinámica en el Plano Inclinado</h2>

      <p>Analizamos un bloque deslizando por una rampa inclinada descomponiendo las fuerzas sobre ejes rotados.</p>

      <div class="psd-callout psd-callout-book">
        <strong>Ejemplo 2:</strong>
        El bloque tiene una masa de \(m = 3{,}0\text{ kg}\), parte del reposo y desliza por el plano inclinado \(\theta = 37^\circ\). El coeficiente de rozamiento cinético es \(\mu_k = 0{,}20\). (Con \(g = 10\text{ m/s}^2 \implies P = 30\text{ N}\)):
        <div class="psd-formula-box">
          \[ P_x = P \operatorname{sen}(37^\circ) = 30 \cdot 0{,}60 = 18\text{ N} \qquad P_y = P \cos(37^\circ) = 30 \cdot 0{,}80 = 24\text{ N} \]
          Ejes: \(x\) a lo largo del plano (hacia abajo) e \(y\) perpendicular al plano.
          \[ \text{Eje } y: N - P_y = 0 \implies N = P_y = 24\text{ N} \qquad f_k = \mu_k N = 0{,}20 \cdot 24\text{ N} = 4{,}8\text{ N} \]
          \[ \text{Eje } x: P_x - f_k = m a \implies a = \frac{18 - 4{,}8}{3{,}0} = \frac{13{,}2}{3{,}0} = 4{,}4\text{ m/s}^2 \]
        </div>
        Si la longitud del plano inclinado es \(L = 2{,}0\text{ m}\), por cinemática: \(v_f = \sqrt{2 a \Delta x} = \sqrt{2(4{,}4)(2{,}0)} = 4{,}2\text{ m/s}\).
      </div>

      <div class="psd-callout psd-callout-concept">
        <strong>Equilibrio Dinámico (MRU, \(a = 0\)):</strong>
        Si un cuerpo desciende con velocidad constante:
        \[ m g \operatorname{sen}\theta = \mu_k m g \cos\theta \implies \mu_k = \tan\theta \]
      </div>

      <!-- Simulador 3 ampliado sin superposiciones -->
      <h3>Laboratorio Interactivo: Descenso en Rampa</h3>
      <div class="psd-sim-wrap">
        <div class="psd-canvas-wrap">
          <svg id="sim3-svg" viewBox="0 0 560 360"></svg>
        </div>

        <div class="psd-sim-controls">
          <div class="psd-control-row">
            <div class="psd-control-header">
              <span>Ángulo de inclinación (θ):</span>
              <span id="sim3-deg-val" class="val">37°</span>
            </div>
            <input type="range" id="sim3-deg" min="0" max="60" step="1" value="37" />
          </div>

          <div class="psd-control-row">
            <div class="psd-control-header">
              <span>Masa del bloque (m):</span>
              <span id="sim3-m-val" class="val">3,0 kg</span>
            </div>
            <input type="range" id="sim3-m" min="0.5" max="15" step="0.5" value="3" />
          </div>

          <div class="psd-control-row">
            <div class="psd-control-header">
              <span>Coeficiente cinético (μk):</span>
              <span id="sim3-uk-val" class="val">0,20</span>
            </div>
            <input type="range" id="sim3-uk" min="0.0" max="0.75" step="0.05" value="0.20" />
          </div>

          <div class="psd-readout-panel">
            <div class="psd-readout-item">
              <span class="label">Pₓ (a lo largo del plano)</span>
              <span id="sim3-out-px" class="val">--</span>
            </div>
            <div class="psd-readout-item">
              <span class="label">Pᵧ (perpendicular al plano)</span>
              <span id="sim3-out-py" class="val">--</span>
            </div>
            <div class="psd-readout-item">
              <span class="label">Normal N</span>
              <span id="sim3-out-n" class="val">--</span>
            </div>
            <div class="psd-readout-item">
              <span class="label">Fricción fk</span>
              <span id="sim3-out-fk" class="val">--</span>
            </div>
            <div class="psd-readout-item">
              <span class="label">Aceleración a</span>
              <span id="sim3-out-a" class="val">--</span>
            </div>
          </div>

          <div style="font-size: 0.85rem; padding: 0.5rem; background: #e0f2fe; border-radius: 6px; color: #0369a1; font-weight: 600;">
            Régimen: <span id="sim3-out-reg">--</span>
          </div>

          <div style="margin-top: 0.5rem;">
            <button id="sim3-btn-anim" class="psd-btn psd-btn-secondary" style="width: 100%;">▶ Iniciar Descenso</button>
          </div>
        </div>
      </div>

      <!-- Microdesafío 3 -->
      <div class="psd-exercise-card">
        <span class="psd-exercise-tag">Microdesafío 3</span>
        <div class="psd-exercise-header">Tobogán con Velocidad Constante</div>
        <p>Un niño de masa \(30\text{ kg}\) baja por un tobogán con velocidad constante cuando la rampa forma un ángulo de \(\theta = 37^\circ\) con la horizontal. Determiná el valor del coeficiente de rozamiento cinético \(\mu_k\).</p>

        <div class="psd-input-group">
          <label for="micro3-uk">Coeficiente de rozamiento cinético (μk):</label>
          <input type="number" step="any" id="micro3-uk" placeholder="ej. 0.75" />
        </div>

        <button id="btn-micro-3" class="psd-btn psd-btn-primary">Verificar Respuesta</button>
        <div id="fb-micro-3" class="psd-feedback"></div>
        <div id="sol-micro-3" class="psd-solution-box" style="display: none;">
          <div class="psd-solution-title">Deducción formal:</div>
          Velocidad constante \(\implies \vec{a} = \vec{0} \implies \Sigma F_x = 0\).<br>
          \(m g \operatorname{sen}(37^\circ) - f_k = 0 \implies \mu_k = \tan(37^\circ) \approx 0{,}7535\).
        </div>
      </div>

      <div style="margin-top: 1.5rem; text-align: right;">
        <button class="psd-btn psd-btn-primary psd-btn-next-tab" data-next="mod4">Continuar a Cuerpos Vinculados →</button>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       MÓDULO 4: CUERPOS VINCULADOS (CON DCLS INDIVIDUALES PREVIOS)
       ========================================================================= -->
  <section id="tab-mod4" class="psd-tab-content">
    <div class="psd-card">
      <h2>4. Sistemas de Cuerpos Vinculados</h2>

      <p>Para resolver cualquier sistema vinculado con cuerdas y poleas ideales debemos cumplir un procedimiento estricto en 4 pasos:</p>

      <div class="psd-callout psd-callout-book">
        <strong>Procedimiento General en 4 Pasos:</strong>
        <ol>
          <li><strong>Paso 1:</strong> Determinar el sentido probable del movimiento del sistema.</li>
          <li><strong>Paso 2:</strong> Realizar el <strong>Diagrama de Cuerpo Libre (DCL) de cada cuerpo por separado</strong>, identificando todas las fuerzas reales aplicadas en cada uno.</li>
          <li><strong>Paso 3:</strong> Plantear para cada cuerpo la ecuación de la 2.ª Ley (\(\Sigma \vec{F} = m \vec{a}\)), tomando como positivo el sentido del movimiento.</li>
          <li><strong>Paso 4:</strong> Resolver el sistema de ecuaciones resultante por reducción sumando miembro a miembro para eliminar la tensión \(T\).</li>
        </ol>
      </div>

      <!-- Paso 1: Esquema Físico y Sentido del Movimiento -->
      <h3>Paso 1: Esquema Físico y Sentido del Movimiento</h3>
      <p>
        Antes de aislar las fuerzas que actúan sobre cada cuerpo, debemos reconocer la <strong>distribución espacial del dispositivo mecánico</strong> y cómo interactúan las masas mediante los vínculos:
      </p>

      <div class="psd-system-schema-container">
        <div class="psd-system-schema-header">
          <span class="psd-schema-badge">Dispositivo Mecánico</span>
          <strong>Masa sobre mesa horizontal (\(m_1\)) vinculada mediante cuerda y polea fija a masa colgante (\(m_2\))</strong>
        </div>

        <div class="psd-system-schema-canvas">
          <svg id="sim4-schema-svg" viewBox="0 0 620 250" width="100%" height="auto">
            <defs>
              <marker id="sch-arr-blue" viewBox="0 0 10 10" refX="7" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse">
                <path d="M 0 1.5 L 8 5 L 0 8.5 z" fill="#2563eb" />
              </marker>
              <marker id="sch-arr-slate" viewBox="0 0 10 10" refX="7" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse">
                <path d="M 0 1.5 L 8 5 L 0 8.5 z" fill="#475569" />
              </marker>
              <pattern id="sch-floor-hatch" width="8" height="8" patternUnits="userSpaceOnUse" patternTransform="rotate(45)">
                <line x1="0" y1="0" x2="0" y2="8" stroke="#cbd5e1" stroke-width="1.5" />
              </pattern>
            </defs>

            <!-- Suelo base -->
            <line x1="20" y1="230" x2="600" y2="230" stroke="#334155" stroke-width="2.5" />
            <rect x="20" y="230" width="580" height="14" fill="url(#sch-floor-hatch)" />

            <!-- Patas de la mesa -->
            <rect x="65" y="126" width="14" height="104" fill="#94a3b8" stroke="#475569" stroke-width="1.5" rx="1" />
            <rect x="322" y="126" width="14" height="104" fill="#94a3b8" stroke="#475569" stroke-width="1.5" rx="1" />

            <!-- Tablero de la Mesa -->
            <rect x="40" y="110" width="340" height="16" fill="#cbd5e1" stroke="#334155" stroke-width="2" rx="2" />
            <!-- Indicador de rugosidad en la mesa -->
            <rect x="110" y="114" width="130" height="9" fill="#e2e8f0" rx="2" />
            <text x="175" y="121.5" text-anchor="middle" font-size="9" fill="#475569" font-weight="700">Superficie con rozamiento (μₖ)</text>

            <!-- Sistema de coordenadas de referencia para Cuerpo 1 -->
            <g transform="translate(60, 48)">
              <line x1="0" y1="0" x2="28" y2="0" stroke="#475569" stroke-width="1.5" marker-end="url(#sch-arr-slate)" />
              <line x1="0" y1="0" x2="0" y2="-24" stroke="#475569" stroke-width="1.5" marker-end="url(#sch-arr-slate)" />
              <text x="32" y="3" font-size="9.5" font-weight="bold" fill="#475569">+x</text>
              <text x="-2" y="-28" font-size="9.5" font-weight="bold" fill="#475569">+y</text>
            </g>

            <!-- Soporte y Polea fija ideal -->
            <path d="M 370 126 L 380 110 L 390 126 Z" fill="#64748b" stroke="#334155" stroke-width="1.5" />
            <circle cx="380" cy="110" r="16" fill="#f1f5f9" stroke="#334155" stroke-width="2.5" />
            <circle cx="380" cy="110" r="11" fill="none" stroke="#94a3b8" stroke-width="1" stroke-dasharray="3,2" />
            <circle cx="380" cy="110" r="3.5" fill="#0f172a" />
            
            <!-- Cartel Polea fija -->
            <line x1="390" y1="96" x2="430" y2="68" stroke="#94a3b8" stroke-width="1.2" stroke-dasharray="2,2" />
            <rect x="420" y="52" width="140" height="22" rx="4" fill="#f8fafc" stroke="#cbd5e1" stroke-width="1" />
            <text x="490" y="67" text-anchor="middle" font-size="10.5" font-weight="600" fill="#334155">Polea fija ideal</text>

            <!-- Bloque 1 (Sobre la mesa) -->
            <rect x="120" y="52" width="86" height="58" rx="4" fill="#ffffff" stroke="#1e293b" stroke-width="2.5" />
            <text x="163" y="77" text-anchor="middle" font-size="13" font-weight="800" fill="#1e293b" id="sim4-schema-m1-lbl">m₁ = 2,0 kg</text>
            <text x="163" y="95" text-anchor="middle" font-size="9.5" font-weight="600" fill="#64748b">Cuerpo 1 (mesa)</text>
                        <circle cx="206" cy="94" r="3" fill="#ea580c" />

            <!-- Cuerda ideal -->
            <line x1="206" y1="94" x2="380" y2="94" stroke="#ea580c" stroke-width="3" stroke-linecap="round" />
            <path d="M 380 94 A 16 16 0 0 1 396 110" fill="none" stroke="#ea580c" stroke-width="3" />
            <line x1="396" y1="110" x2="396" y2="152" stroke="#ea580c" stroke-width="3" stroke-linecap="round" />
            <circle cx="396" cy="152" r="3" fill="#ea580c" />

            <!-- Etiqueta Cuerda ideal sobre el tramo horizontal -->
            <g transform="translate(290, 80)">
              <rect x="-42" y="-10" width="84" height="18" rx="3" fill="#fff7ed" stroke="#fdba74" stroke-width="1" />
              <text x="0" y="3" text-anchor="middle" font-size="9" font-weight="bold" fill="#c2410c">Cuerda ideal</text>
            </g>

            <!-- Bloque 2 (Colgante) -->
            <rect x="350" y="152" width="92" height="54" rx="4" fill="#eff6ff" stroke="#1d4ed8" stroke-width="2.5" />
            <text x="396" y="176" text-anchor="middle" font-size="13" font-weight="800" fill="#1d4ed8" id="sim4-schema-m2-lbl">m₂ = 3,0 kg</text>
            <text x="396" y="194" text-anchor="middle" font-size="9" font-weight="600" fill="#2563eb">Cuerpo 2 (colgante)</text>
            
            <!-- Flechas vectoriales de aceleración del sistema -->
            <!-- Aceleración Bloque 1 (horizontal hacia la derecha) -->
            <line x1="130" y1="36" x2="194" y2="36" stroke="#2563eb" stroke-width="2.5" marker-end="url(#sch-arr-blue)" />
            <g transform="translate(162, 22)">
              <rect x="-44" y="-10" width="88" height="18" rx="3" fill="#eff6ff" stroke="#bfdbfe" stroke-width="1" />
              <text x="0" y="3" text-anchor="middle" font-size="10" font-weight="bold" fill="#1d4ed8">→ <tspan class="sch-vec">a</tspan>₁ (Sentido +x)</text>
            </g>

            <!-- Aceleración Bloque 2 (vertical hacia abajo) -->
            <line x1="462" y1="160" x2="462" y2="202" stroke="#2563eb" stroke-width="2.5" marker-end="url(#sch-arr-blue)" />
            <g transform="translate(515, 182)">
              <rect x="-48" y="-10" width="96" height="18" rx="3" fill="#eff6ff" stroke="#bfdbfe" stroke-width="1" />
              <text x="0" y="3" text-anchor="middle" font-size="10" font-weight="bold" fill="#1d4ed8">↓ <tspan class="sch-vec">a</tspan>₂ (Sentido +y)</text>
            </g>

            <!-- Vínculo de magnitud: |a1| = |a2| = a -->
            <g transform="translate(510, 115)">
              <rect x="-65" y="-13" width="130" height="26" rx="5" fill="#f8fafc" stroke="#94a3b8" stroke-width="1.2" stroke-dasharray="3,2" />
              <text x="0" y="4" text-anchor="middle" font-size="11" font-weight="700" fill="#0f172a">|<tspan class="sch-vec">a</tspan>₁| = |<tspan class="sch-vec">a</tspan>₂| = a</text>
            </g>
          </svg>
          <script>
          /* Flecha vectorial dibujada en SVG sobre cada letra .sch-vec (el carácter combinante U+20D7 no existe en la mayoría de las fuentes). */
          (function () {
            var svg = document.getElementById('sim4-schema-svg');
            if (!svg) return;
            var NS = 'http://www.w3.org/2000/svg';
            function draw() {
              Array.prototype.forEach.call(svg.querySelectorAll('.sch-vec-arrow'), function (n) { n.remove(); });
              Array.prototype.forEach.call(svg.querySelectorAll('tspan.sch-vec'), function (ts) {
                var t = ts.parentNode, ch, box, fs, base, y, x1, x2, g, color;
                try {
                  ch = ts.getStartPositionOfChar(0);
                  box = ts.getExtentOfChar(0);
                } catch (e) { return; }
                if (!box.width) return;
                fs = parseFloat(t.getAttribute('font-size')) || 10;
                color = t.getAttribute('fill') || '#000';
                var upper = ts.textContent === ts.textContent.toUpperCase();
                base = ch.y;
                y = base - (upper ? 0.72 : 0.54) * fs - 2.5;
                x1 = box.x + 0.5; x2 = box.x + box.width - 0.5;
                g = document.createElementNS(NS, 'path');
                g.setAttribute('class', 'sch-vec-arrow');
                g.setAttribute('d', 'M' + x1 + ' ' + y + 'H' + x2 + 'M' + (x2 - 2.2) + ' ' + (y - 1.7) + 'L' + x2 + ' ' + y + 'L' + (x2 - 2.2) + ' ' + (y + 1.7));
                g.setAttribute('fill', 'none');
                g.setAttribute('stroke', color);
                g.setAttribute('stroke-width', '0.9');
                g.setAttribute('stroke-linecap', 'round');
                g.setAttribute('stroke-linejoin', 'round');
                t.parentNode.appendChild(g);
              });
            }
            draw();
            if (document.fonts && document.fonts.ready) document.fonts.ready.then(draw);
            window.addEventListener('load', draw);
            if (window.ResizeObserver) new ResizeObserver(draw).observe(svg);
          })();
          </script>
        </div>

        <div class="psd-schema-legend-grid">
          <div class="psd-schema-legend-item">
            <span class="legend-dot dot-m1"></span>
            <div>
              <strong>Cuerpo 1 (\(m_1\)):</strong> Apoyado sobre la superficie horizontal con fricción (\(\mu_k\)). Aceleración sobre el eje \(x\): \(a_{1x} = +a\) (hacia la derecha, sentido \(+x\)).
            </div>
          </div>
          <div class="psd-schema-legend-item">
            <span class="legend-dot dot-m2"></span>
            <div>
              <strong>Cuerpo 2 (\(m_2\)):</strong> Suspendido libremente en el aire. Aceleración sobre el eje \(y\): \(a_{2y} = -a\) (hacia abajo, sentido contrario a \(+y\)).
            </div>
          </div>
          <div class="psd-schema-legend-item">
            <span class="legend-dot dot-rope"></span>
            <div>
              <strong>Cuerda ideal:</strong> Inextensible y de masa despreciable. Transmite la misma tensión \(T\) a ambos bloques y garantiza igual módulo de aceleración (\(|\vec{a}_1| = |\vec{a}_2| = a\)).
            </div>
          </div>
          <div class="psd-schema-legend-item">
            <span class="legend-dot dot-pulley"></span>
            <div>
              <strong>Polea fija ideal:</strong> Sin rozamiento ni momento de inercia (\(m_{\text{polea}} \approx 0\)). Cambia la dirección de la cuerda sin alterar el módulo de \(T\).
            </div>
          </div>
        </div>
      </div>

      <!-- DCLs separados para cada caja -->
      <h3>Paso 2: Diagramas de Cuerpo Libre (DCL) Separados</h3>
      <p>Observá el aislamiento formal de cada cuerpo antes de acoplar el sistema:</p>

      <div class="psd-dcl-grid">
        <!-- DCL Caja 1 -->
        <div class="psd-dcl-box">
          <div class="psd-dcl-title">📦 DCL Cuerpo 1 (Bloque sobre la mesa)</div>
          <div class="psd-dcl-canvas">
            <svg id="sim4-dcl1-svg" viewBox="0 0 280 240"></svg>
          </div>
          <div class="psd-formula-box" style="font-size: 0.88rem;">
            \[ \text{Eje } y: N_1 - P_1 = 0 \implies N_1 = m_1 g \]
            \[ \text{Eje } x: T - f_k = m_1 a \quad \text{(Ecuación 1)} \]
          </div>
        </div>

        <!-- DCL Caja 2 -->
        <div class="psd-dcl-box">
          <div class="psd-dcl-title">🪢 DCL Cuerpo 2 (Masa suspendida)</div>
          <div class="psd-dcl-canvas">
            <svg id="sim4-dcl2-svg" viewBox="0 0 280 240"></svg>
          </div>
          <div class="psd-formula-box" style="font-size: 0.88rem;">
            \[ \text{Eje } y: P_2 - T = m_2 a \quad \text{(Ecuación 2)} \]
            \[ \text{Eje } x: \text{No actúan fuerzas horizontales} \]
          </div>
        </div>
      </div>

      <div class="psd-callout psd-callout-law">
        <strong>Resolución del Sistema Acoplado:</strong>
        Sumando miembro a miembro las ecuaciones (1) y (2):
        <div class="psd-formula-box">
          \[ (T - f_k) + (m_2 g - T) = (m_1 + m_2) a \implies a = \frac{m_2 g - f_k}{m_1 + m_2} \]
          \[ T = m_1 a + f_k = m_2(g - a) \]
        </div>
      </div>

      <!-- Simulador interactivo del sistema conjunto -->
      <h3>Laboratorio del Sistema Vinculado y Corte de Cuerda</h3>
      <p>Probá la aceleración conjunta y experimentá qué ocurre con cada cuerpo al cortar la cuerda en pleno movimiento:</p>

      <div class="psd-sim-wrap">
        <div class="psd-canvas-wrap">
          <svg id="sim4-svg" viewBox="0 0 440 260"></svg>
        </div>

        <div class="psd-sim-controls">
          <div class="psd-control-row">
            <div class="psd-control-header">
              <span>Masa en mesa (m₁):</span>
              <span id="sim4-m1-val" class="val">2,0 kg</span>
            </div>
            <input type="range" id="sim4-m1" min="0.5" max="10" step="0.5" value="2" />
          </div>

          <div class="psd-control-row">
            <div class="psd-control-header">
              <span>Masa colgante (m₂):</span>
              <span id="sim4-m2-val" class="val">3,0 kg</span>
            </div>
            <input type="range" id="sim4-m2" min="0.5" max="10" step="0.5" value="3" />
          </div>

          <div class="psd-control-row">
            <div class="psd-control-header">
              <span>Coeficiente cinético mesa (μk):</span>
              <span id="sim4-uk-val" class="val">0,20</span>
            </div>
            <input type="range" id="sim4-uk" min="0.0" max="0.6" step="0.05" value="0.20" />
          </div>

          <div class="psd-readout-panel">
            <div class="psd-readout-item">
              <span class="label">Rozamiento fk</span>
              <span id="sim4-out-fk" class="val">--</span>
            </div>
            <div class="psd-readout-item">
              <span class="label">Aceleración a</span>
              <span id="sim4-out-a" class="val">--</span>
            </div>
            <div class="psd-readout-item">
              <span class="label">Tensión T</span>
              <span id="sim4-out-t" class="val">--</span>
            </div>
          </div>

          <div style="font-size: 0.85rem; padding: 0.5rem; background: #e0f2fe; border-radius: 6px; color: #0369a1; font-weight: 600;">
            <span id="sim4-out-estado">--</span>
          </div>

          <div style="display: flex; gap: 0.5rem; margin-top: 0.5rem;">
            <button id="sim4-btn-soltar" class="psd-btn psd-btn-secondary" style="flex: 1;">▶ Soltar Sistema</button>
            <button id="sim4-btn-cortar" class="psd-btn psd-btn-outline" style="flex: 1; border-color: #ef4444; color: #ef4444;">✂ ¡Cortar Cuerda!</button>
          </div>
        </div>
      </div>

      <!-- Microdesafío 4 -->
      <div class="psd-exercise-card">
        <span class="psd-exercise-tag">Microdesafío 4</span>
        <div class="psd-exercise-header">Tren de Tres Cuerpos Vinculados</div>
        <p>Se tira de un tren de tres vagones con masas \(m_1 = 0{,}20\text{ kg}\), \(m_2 = 0{,}10\text{ kg}\) y \(m_3 = 0{,}30\text{ kg}\) mediante una fuerza horizontal \(F = 1{,}5\text{ N}\) sobre una superficie horizontal lisa (sin fricción). Hallar la aceleración y la tensión \(T_1\) en la cuerda que une el vagón 1 con el 2.</p>

        <div class="psd-input-group">
          <label for="micro4-a">Aceleración del sistema (a):</label>
          <input type="number" step="any" id="micro4-a" placeholder="ej. 2.5" />
          <span class="psd-unit">m/s²</span>
        </div>

        <div class="psd-input-group">
          <label for="micro4-t1">Tensión T1 (vínculo con vagón 1):</label>
          <input type="number" step="any" id="micro4-t1" placeholder="ej. 0.5" />
          <span class="psd-unit">N</span>
        </div>

        <button id="btn-micro-4" class="psd-btn psd-btn-primary">Verificar Respuesta</button>
        <div id="fb-micro-4" class="psd-feedback"></div>
        <div id="sol-micro-4" class="psd-solution-box" style="display: none;">
          <div class="psd-solution-title">Resolución analítica:</div>
          1. Masa total: \(m_T = 0{,}20 + 0{,}10 + 0{,}30 = 0{,}60\text{ kg}\).<br>
          2. Aceleración: \(a = \frac{1{,}5}{0{,}60} = 2{,}5\text{ m/s}^2\).<br>
          3. DCL Vagón 1: \(\Sigma F_{1x} = T_1 = m_1 a = 0{,}20\text{ kg} \cdot 2{,}5\text{ m/s}^2 = 0{,}50\text{ N}\).
        </div>
      </div>

      <div style="margin-top: 1.5rem; text-align: right;">
        <button class="psd-btn psd-btn-primary psd-btn-next-tab" data-next="mod5">Continuar a Acople Cinemático →</button>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       MÓDULO 5: ACOPLE DINÁMICA - CINEMÁTICA 
       ========================================================================= -->
  <section id="tab-mod5" class="psd-tab-content">
    <div class="psd-card">
      <h2>5. Acoplamiento Dinámica y Cinemática Rectilínea</h2>

      <p>Estudiamos la relación causal entre la fuerza neta y el movimiento resultante:</p>

      <div class="psd-callout psd-callout-book">
        <strong>Ejemplo:</strong>
        Un bloque de masa \(m\) que se mueve con velocidad \(v_0 = 4{,}0\text{ m/s}\) por un plano horizontal entra en una zona rugosa deteniéndose después de recorrer \(\Delta x = 5{,}0\text{ m}\). ¿Cuánto vale el coeficiente de rozamiento?
        <br><br>
        <strong>1. Cinemática (Ecuación de Torricelli para \(v_f = 0\)):</strong>
        \[ v_f^2 = v_0^2 + 2 a \Delta x \implies 0 = (4{,}0)^2 + 2 a (5{,}0) \implies a = -1{,}6\text{ m/s}^2 \]
        <strong>2. Dinámica (Segunda Ley de Newton en el eje horizontal):</strong>
        \[ \Sigma F_x = -f_k = m a \implies -\mu_k m g = m a \implies \mu_k = \frac{|a|}{g} = \frac{1{,}6}{10} = 0{,}16 \]
        <em>Conclusión notable:</em> ¡La masa \(m\) del bloque se simplifica! Para una misma velocidad y distancia de frenado, el coeficiente es independiente de la masa.
      </div>

      <!-- Simulador de Frenado Dinámico -->
      <h3>Laboratorio de Frenado en Zona Rugosa</h3>
      <p>Ajustá la velocidad inicial de entrada y el coeficiente \(\mu_k\) para ver la gráfica \(v(t)\) y la distancia de frenado en tiempo real:</p>

      <div class="psd-sim-wrap">
        <div>
          <!-- Pista animada -->
          <div class="psd-canvas-wrap" style="min-height: 140px; margin-bottom: 0.75rem;">
            <svg id="sim5-track-svg" viewBox="0 0 460 140"></svg>
          </div>
          <!-- Gráfica v(t) -->
          <div class="psd-canvas-wrap" style="min-height: 160px;">
            <svg id="sim5-plot-svg" viewBox="0 0 300 150"></svg>
          </div>
        </div>

        <div class="psd-sim-controls">
          <div class="psd-control-row">
            <div class="psd-control-header">
              <span>Velocidad de entrada (v₀):</span>
              <span id="sim5-v0-val" class="val">4,0 m/s</span>
            </div>
            <input type="range" id="sim5-v0" min="2" max="10" step="0.5" value="4" />
          </div>

          <div class="psd-control-row">
            <div class="psd-control-header">
              <span>Coeficiente cinético (μk):</span>
              <span id="sim5-uk-val" class="val">0,16</span>
            </div>
            <input type="range" id="sim5-uk" min="0.05" max="0.50" step="0.01" value="0.16" />
          </div>

          <div class="psd-readout-panel">
            <div class="psd-readout-item">
              <span class="label">Aceleración a</span>
              <span id="sim5-out-a" class="val">--</span>
            </div>
            <div class="psd-readout-item">
              <span class="label">Distancia Δx</span>
              <span id="sim5-out-d" class="val">--</span>
            </div>
            <div class="psd-readout-item">
              <span class="label">Tiempo t_frenado</span>
              <span id="sim5-out-t" class="val">--</span>
            </div>
          </div>

          <div style="margin-top: 0.5rem;">
            <button id="sim5-btn-play" class="psd-btn psd-btn-primary" style="width: 100%;">▶ Iniciar Frenado</button>
          </div>
        </div>
      </div>

      <!-- Microdesafío 5 -->
      <div class="psd-exercise-card">
        <span class="psd-exercise-tag">Microdesafío 5</span>
        <div class="psd-exercise-header">Cálculo de Coeficiente a partir del Frenado</div>
        <p>Un bloque que se desplaza a \(v_0 = 4{,}0\text{ m/s}\) ingresa en una zona rugosa y se frena completamente en una distancia de \(5{,}0\text{ m}\). Calculá el valor del coeficiente de rozamiento \(\mu_k\).</p>

        <div class="psd-input-group">
          <label for="micro5-uk">Coeficiente de rozamiento (μk):</label>
          <input type="number" step="any" id="micro5-uk" placeholder="ej. 0.16" />
        </div>

        <button id="btn-micro-5" class="psd-btn psd-btn-primary">Verificar Respuesta</button>
        <div id="fb-micro-5" class="psd-feedback"></div>
        <div id="sol-micro-5" class="psd-solution-box" style="display: none;">
          <div class="psd-solution-title">Resolución paso a paso:</div>
          1. \(v_f^2 = v_0^2 + 2a\Delta x \implies 0 = 16 + 10a \implies a = -1{,}6\text{ m/s}^2\).<br>
          2. \(\Sigma F_x = -\mu m g = m a \implies \mu = \frac{|a|}{g} = \frac{1{,}6}{9{,}8} \approx 0{,}163\) (o \(0{,}16\) con \(g=10\)).
        </div>
      </div>

      <div style="margin-top: 1.5rem; text-align: right;">
        <button class="psd-btn psd-btn-primary psd-btn-next-tab" data-next="mod6">Ir al Taller de Problemas →</button>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       MÓDULO 6: TALLER DE PROBLEMAS
       ========================================================================= -->
  <section id="tab-mod6" class="psd-tab-content">
    <div class="psd-card">
      <h2>6. Taller de problemas</h2>
      <p>Seleccioná cualquiera de los problemas. Ingresá tus cálculos numéricos (el sistema admite tanto \(g = 9{,}8\text{ m/s}^2\) como aproximaciones con \(g = 10\text{ m/s}^2\)) y consultá el planteo formal analítico.</p>

      <div class="psd-workshop-grid">
        <div class="psd-prob-list">
          <div style="font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 0.25rem;">Problemas del Taller</div>
          <button class="psd-prob-btn active" id="psd-pbtn-1" data-pid="1">
            <span>1. El ropero estático</span>
            <span class="status-icon">○</span>
          </button>
          <button class="psd-prob-btn" id="psd-pbtn-2" data-pid="2">
            <span>2. Cajón con μs y μk</span>
            <span class="status-icon">○</span>
          </button>
          <button class="psd-prob-btn" id="psd-pbtn-3" data-pid="3">
            <span>3. Tobogán con v = cte</span>
            <span class="status-icon">○</span>
          </button>
          <button class="psd-prob-btn" id="psd-pbtn-4" data-pid="4">
            <span>4. Fuerza oblicua</span>
            <span class="status-icon">○</span>
          </button>
          <button class="psd-prob-btn" id="psd-pbtn-5" data-pid="5">
            <span>5. Tres vagones en línea</span>
            <span class="status-icon">○</span>
          </button>
          <button class="psd-prob-btn" id="psd-pbtn-6" data-pid="6">
            <span>6. Masa en mesa y colgante</span>
            <span class="status-icon">○</span>
          </button>
          <button class="psd-prob-btn" id="psd-pbtn-7" data-pid="7">
            <span>7. Elevador acelerado</span>
            <span class="status-icon">○</span>
          </button>
          <button class="psd-prob-btn" id="psd-pbtn-8" data-pid="8">
            <span>8. Rampa y cinemática</span>
            <span class="status-icon">○</span>
          </button>
        </div>

        <div class="psd-prob-display">
          <div id="psd-prob-content"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       MÓDULO 7: BANCO AMPLIADO DE PROBLEMAS Y PREGUNTAS RESUELTAS
       ========================================================================= -->
  <section id="tab-mod7" class="psd-tab-content">
    <div class="psd-card">
      <h2>7. Banco Ampliado de Problemas y Preguntas Resueltas</h2>
      <p>Poné a prueba tu comprensión conceptual y destreza analítica seleccionando la opción que consideres correcta. Al hacer clic en <strong>Comprobar Respuesta</strong>, recibirás <strong>retroalimentación instantánea</strong> junto con la <strong>solución analítica y justificación física detallada</strong>.</p>

      <!-- Pregunta 1: Razonamiento Primera y Segunda Ley -->
      <div class="psd-bank-item" id="bank-q-1">
        <div class="psd-quiz-header">
          <span class="psd-bank-badge">Primera y Segunda Ley · Ejercicio 34 & 38</span>
          <span class="psd-quiz-status" id="bank-status-1">○ Sin responder</span>
        </div>
        <h3>1. Mitos y Verdades sobre el Movimiento y las Fuerzas</h3>
        <div class="psd-quiz-statement">
          En el estudio de las leyes del movimiento de Newton, un estudiante propone varias conclusiones sobre la relación entre fuerza neta, inercia, masa y aceleración. ¿Cuál de las siguientes afirmaciones es <strong>físicamente CORRECTA</strong>?
        </div>
        <div class="psd-quiz-options" data-qid="1">
          <label class="psd-quiz-option">
            <input type="radio" name="bank-opt-1" value="A">
            <span class="opt-letter">A</span>
            <span class="opt-text">Si la fuerza neta que actúa sobre un cuerpo es nula (\(\Sigma \vec{F} = \vec{0}\)), el objeto permanece obligatoriamente en reposo estático.</span>
          </label>
          <label class="psd-quiz-option">
            <input type="radio" name="bank-opt-1" value="B">
            <span class="opt-letter">B</span>
            <span class="opt-text">Si un objeto se mueve en línea recta a velocidad constante, se requiere una fuerza neta continua actuando en el sentido del movimiento para evitar que se detenga.</span>
          </label>
          <label class="psd-quiz-option">
            <input type="radio" name="bank-opt-1" value="C">
            <span class="opt-letter">C</span>
            <span class="opt-text">Si la fuerza neta aplicada sobre un cuerpo se duplica (\(2F\)) y al mismo tiempo su masa se reduce a la mitad (\(m/2\)), la aceleración resultante se cuadruplica (\(4a\)).</span>
          </label>
          <label class="psd-quiz-option">
            <input type="radio" name="bank-opt-1" value="D">
            <span class="opt-letter">D</span>
            <span class="opt-text">Un objeto aislado puede modificar por sí solo la velocidad de su centro de masa mediante la acción de sus propias fuerzas internas.</span>
          </label>
        </div>
        <div class="psd-quiz-actions">
          <button class="psd-btn psd-btn-primary psd-btn-check-quiz" data-qid="1">Comprobar Respuesta</button>
          <button class="psd-btn psd-btn-outline psd-btn-retry-quiz" data-qid="1" style="display: none;">Reintentar ↺</button>
        </div>
        <div id="bank-fb-1" class="psd-feedback"></div>
        <div id="bank-sol-1" class="psd-solution-box" style="display: none;">
          <div class="psd-solution-title">Retroalimentación y Justificación Física:</div>
          <strong>• Por qué la Opción C es la CORRECTA:</strong><br>
          Por la 2.ª Ley de Newton, la aceleración es directamente proporcional a la fuerza neta e inversamente proporcional a la masa (\(a = \frac{\Sigma F}{m}\)). Al sustituir los nuevos valores:
          \[ a' = \frac{\Sigma F'}{m'} = \frac{2F}{\frac{m}{2}} = 2 \cdot 2 \left(\frac{F}{m}\right) = 4\left(\frac{F}{m}\right) = 4a \]
          La aceleración se multiplica exactamente por cuatro.<br><br>
          <strong>• Por qué las demás opciones son incorrectas (ideas previas erróneas):</strong><br>
          <strong>– Opción A (Falsa):</strong> Por la 1.ª Ley de Newton (Principio de Inercia), si \(\Sigma \vec{F} = \vec{0}\), el cuerpo puede encontrarse en reposo <em>O</em> en Movimiento Rectilíneo Uniforme (MRU, \(\vec{v} = \text{cte}\)). La ausencia de fuerza neta implica aceleración cero, no reposo obligatorio.<br>
          <strong>– Opción B (Falsa):</strong> Es la clásica confusión aristotélica. En un MRU la fuerza neta es nula (\(\vec{a} = \vec{0} \implies \Sigma \vec{F} = \vec{0}\)). La fuerza neta es la causa del <em>cambio</em> de velocidad (aceleración), jamás de la persistencia del movimiento.<br>
          <strong>– Opción D (Falsa):</strong> Por la 3.ª Ley de Newton, las fuerzas internas se cancelan de a pares y no pueden modificar la cantidad de movimiento total del centro de masa. Solo una fuerza externa neta puede acelerar un sistema.
        </div>
      </div>

      <!-- Pregunta 2: Tercera Ley de Newton (Maletín y Acción-Reacción) -->
      <div class="psd-bank-item" id="bank-q-2">
        <div class="psd-quiz-header">
          <span class="psd-bank-badge">Tercera Ley · Ejercicio 42</span>
          <span class="psd-quiz-status" id="bank-status-2">○ Sin responder</span>
        </div>
        <h3>2. El Caso de la Persona con el Maletín y el Par de Interacción</h3>
        <div class="psd-quiz-statement">
          Una persona se encuentra de pie en reposo sosteniendo un maletín de masa \(m\) mientras espera el autobús. ¿Cuál de las siguientes afirmaciones sobre las fuerzas que actúan en este sistema es <strong>RIGUROSAMENTE CORRECTA</strong> según la Tercera Ley de Newton?
        </div>
        <div class="psd-quiz-options" data-qid="2">
          <label class="psd-quiz-option">
            <input type="radio" name="bank-opt-2" value="A">
            <span class="opt-letter">A</span>
            <span class="opt-text">La fuerza hacia arriba que ejerce la mano sobre el maletín y el peso del maletín forman un par de acción y reacción por la Tercera Ley.</span>
          </label>
          <label class="psd-quiz-option">
            <input type="radio" name="bank-opt-2" value="B">
            <span class="opt-letter">B</span>
            <span class="opt-text">La fuerza que la mano ejerce sobre el maletín y la que el maletín ejerce sobre la mano tienen igual módulo, misma dirección, sentidos contrarios y están aplicadas sobre cuerpos distintos.</span>
          </label>
          <label class="psd-quiz-option">
            <input type="radio" name="bank-opt-2" value="C">
            <span class="opt-letter">C</span>
            <span class="opt-text">La fuerza de reacción al peso del maletín es la fuerza normal que el piso ejerce sobre los zapatos de la persona.</span>
          </label>
          <label class="psd-quiz-option">
            <input type="radio" name="bank-opt-2" value="D">
            <span class="opt-letter">D</span>
            <span class="opt-text">Como el maletín está en reposo estático, no ejerce ninguna fuerza sobre la mano de la persona.</span>
          </label>
        </div>
        <div class="psd-quiz-actions">
          <button class="psd-btn psd-btn-primary psd-btn-check-quiz" data-qid="2">Comprobar Respuesta</button>
          <button class="psd-btn psd-btn-outline psd-btn-retry-quiz" data-qid="2" style="display: none;">Reintentar ↺</button>
        </div>
        <div id="bank-fb-2" class="psd-feedback"></div>
        <div id="bank-sol-2" class="psd-solution-box" style="display: none;">
          <div class="psd-solution-title">Retroalimentación y Justificación Física:</div>
          <strong>• Por qué la Opción B es la CORRECTA:</strong><br>
          La interacción de contacto entre la mano de la persona y el asa del maletín constituye un verdadero par de acción y reacción de la 3.ª Ley:
          \[ \vec{F}_{\text{mano}\to\text{maletín}} = -\vec{F}_{\text{maletín}\to\text{mano}} \]
          Tienen exactamente el mismo módulo y dirección, sentidos opuestos, y <em>están aplicadas sobre cuerpos distintos</em> (una sobre el maletín y la otra sobre la mano), por lo que nunca se cancelan entre sí.<br><br>
          <strong>• Por qué las demás opciones son incorrectas:</strong><br>
          <strong>– Opción A (Falsa):</strong> Tanto la fuerza de la mano como el peso están aplicadas <em>sobre el mismo cuerpo</em> (el maletín). Que sumen cero es una condición de equilibrio traslacional por la 1.ª Ley (\(\Sigma \vec{F} = \vec{0}\)), pero jamás un par de interacción de la 3.ª Ley.<br>
          <strong>– Opción C (Falsa):</strong> El peso del maletín es la atracción gravitatoria que el planeta Tierra ejerce sobre el maletín (\(\vec{F}_{\text{Tierra}\to\text{maletín}}\)). Su correspondiente par de reacción es la atracción gravitatoria que el maletín ejerce sobre la Tierra (\(\vec{F}_{\text{maletín}\to\text{Tierra}}\)), aplicada en el centro del planeta.<br>
          <strong>– Opción D (Falsa):</strong> La 3.ª Ley de Newton es simultánea y obligatoria. La mano experimenta una fuerza hacia abajo igual al módulo de la fuerza con que sostiene al maletín.
        </div>
      </div>

      <!-- Pregunta 3: El Trineo del Padre y el Hijo -->
      <div class="psd-bank-item" id="bank-q-3">
        <div class="psd-quiz-header">
          <span class="psd-bank-badge">Fuerzas Especiales · Ejercicio 50</span>
          <span class="psd-quiz-status" id="bank-status-3">○ Sin responder</span>
        </div>
        <h3>3. El Padre Empujando el Trineo: Efecto en la Normal y el Rozamiento</h3>
        <div class="psd-quiz-statement">
          Un padre desea desplazar a su hijo sentado en un trineo sobre nieve horizontal rugosa (coeficiente cinético \(\mu_k\)). Para ello evalúa aplicar una fuerza de igual módulo \(F\) de tres maneras diferentes:
          <ul>
            <li><strong>Caso 1:</strong> Empujar inclinado hacia abajo (formando un ángulo \(\alpha > 0^\circ\) con la horizontal).</li>
            <li><strong>Caso 2:</strong> Empujar estrictamente horizontal (\(\alpha = 0^\circ\)).</li>
            <li><strong>Caso 3:</strong> Tirar de una cuerda inclinada hacia arriba (formando un ángulo \(\alpha > 0^\circ\) con la horizontal).</li>
          </ul>
          ¿En cuál de las tres formas la <strong>fuerza de rozamiento cinético (\(f_k\)) será MENOR</strong>, facilitando el avance?
        </div>
        <div class="psd-quiz-options" data-qid="3">
          <label class="psd-quiz-option">
            <input type="radio" name="bank-opt-3" value="A">
            <span class="opt-letter">A</span>
            <span class="opt-text">En el Caso 1 (empujar hacia abajo), porque la componente vertical compacta la nieve facilitando el deslizamiento.</span>
          </label>
          <label class="psd-quiz-option">
            <input type="radio" name="bank-opt-3" value="B">
            <span class="opt-letter">B</span>
            <span class="opt-text">En el Caso 2 (horizontal), porque la fuerza no se descompone y actúa íntegramente en la dirección del movimiento.</span>
          </label>
          <label class="psd-quiz-option">
            <input type="radio" name="bank-opt-3" value="C">
            <span class="opt-letter">C</span>
            <span class="opt-text">En el Caso 3 (tirar hacia arriba), porque la componente vertical hacia arriba alivia el apoyo del trineo, disminuyendo la fuerza Normal y por tanto el rozamiento (\(f_k = \mu_k N\)).</span>
          </label>
          <label class="psd-quiz-option">
            <input type="radio" name="bank-opt-3" value="D">
            <span class="opt-letter">D</span>
            <span class="opt-text">En los tres casos el rozamiento es idéntico, ya que la masa combinada del trineo y el niño no varía.</span>
          </label>
        </div>
        <div class="psd-quiz-actions">
          <button class="psd-btn psd-btn-primary psd-btn-check-quiz" data-qid="3">Comprobar Respuesta</button>
          <button class="psd-btn psd-btn-outline psd-btn-retry-quiz" data-qid="3" style="display: none;">Reintentar ↺</button>
        </div>
        <div id="bank-fb-3" class="psd-feedback"></div>
        <div id="bank-sol-3" class="psd-solution-box" style="display: none;">
          <div class="psd-solution-title">Retroalimentación y Demostración Analítica:</div>
          <strong>• Por qué la Opción C es la CORRECTA:</strong><br>
          La fuerza de rozamiento cinético está dada por \(f_k = \mu_k N\). Analicemos el equilibrio en el eje vertical (\(\Sigma F_y = 0\)) para los tres casos:
          <br><br>
          <strong>1. Caso 1 (empuje inclinado hacia abajo):</strong><br>
          La componente vertical \(F_y = F\operatorname{sen}\alpha\) presiona hacia abajo sumándose al peso:
          \[ \Sigma F_y = N_1 - P - F\operatorname{sen}\alpha = 0 \implies N_1 = mg + F\operatorname{sen}\alpha \]
          \[ f_{k,1} = \mu_k(mg + F\operatorname{sen}\alpha) \quad \text{(¡Es la opción con mayor rozamiento de todas!)} \]
          <strong>2. Caso 2 (empuje horizontal, \(\alpha = 0^\circ\)):</strong><br>
          \[ N_2 = mg \implies f_{k,2} = \mu_k mg \]
          <strong>3. Caso 3 (tirar inclinado hacia arriba):</strong><br>
          La componente vertical \(F_y = F\operatorname{sen}\alpha\) tira hacia arriba, descargando el contacto con el suelo:
          \[ \Sigma F_y = N_3 + F\operatorname{sen}\alpha - P = 0 \implies N_3 = mg - F\operatorname{sen}\alpha \]
          \[ f_{k,3} = \mu_k(mg - F\operatorname{sen}\alpha) \]
          Como \(N_3 < N_2 < N_1\), se deduce inmediatamente que:
          \[ f_{k,3} < f_{k,2} < f_{k,1} \]
          Tirar de la cuerda hacia arriba es la forma mecánicamente más ventajosa y eficiente.
        </div>
      </div>

      <!-- Pregunta 4: Disco de Hockey en Hielo -->
      <div class="psd-bank-item" id="bank-q-4">
        <div class="psd-quiz-header">
          <span class="psd-bank-badge">Cinemática y Rozamiento · Ejercicio 51</span>
          <span class="psd-quiz-status" id="bank-status-4">○ Sin responder</span>
        </div>
        <h3>4. Frenado del Disco de Hockey sobre el Hielo</h3>
        <div class="psd-quiz-statement">
          Un disco de hockey sale disparado sobre una pista horizontal helada con rapidez inicial \(v_0 = 18\text{ m/s}\) y se detiene completamente por fricción tras recorrer una distancia de \(\Delta x = 80\text{ m}\). Sabiendo que la aceleración gravitatoria es \(g = 9{,}8\text{ m/s}^2\), ¿cuánto vale el <strong>coeficiente de rozamiento cinético (\(\mu_k\))</strong> entre el disco y el hielo?
        </div>
        <div class="psd-quiz-options" data-qid="4">
          <label class="psd-quiz-option">
            <input type="radio" name="bank-opt-4" value="A">
            <span class="opt-letter">A</span>
            <span class="opt-text">\(\mu_k \approx 0{,}103\)</span>
          </label>
          <label class="psd-quiz-option">
            <input type="radio" name="bank-opt-4" value="B">
            <span class="opt-letter">B</span>
            <span class="opt-text">\(\mu_k \approx 0{,}207\) (o \(\approx 0{,}202\) si se toma \(g = 10\text{ m/s}^2\))</span>
          </label>
          <label class="psd-quiz-option">
            <input type="radio" name="bank-opt-4" value="C">
            <span class="opt-letter">C</span>
            <span class="opt-text">\(\mu_k \approx 0{,}414\)</span>
          </label>
          <label class="psd-quiz-option">
            <input type="radio" name="bank-opt-4" value="D">
            <span class="opt-letter">D</span>
            <span class="opt-text">No es posible calcularlo porque el enunciado no proporciona la masa \(m\) del disco.</span>
          </label>
        </div>
        <div class="psd-quiz-actions">
          <button class="psd-btn psd-btn-primary psd-btn-check-quiz" data-qid="4">Comprobar Respuesta</button>
          <button class="psd-btn psd-btn-outline psd-btn-retry-quiz" data-qid="4" style="display: none;">Reintentar ↺</button>
        </div>
        <div id="bank-fb-4" class="psd-feedback"></div>
        <div id="bank-sol-4" class="psd-solution-box" style="display: none;">
          <div class="psd-solution-title">Retroalimentación y Resolución Paso a Paso:</div>
          <strong>• Por qué la Opción B es la CORRECTA:</strong><br>
          <strong>Paso 1: Deducción de la aceleración de frenado con Cinemática (Ecuación de Torricelli):</strong><br>
          Al detenerse, la velocidad final es \(v_f = 0\):
          \[ v_f^2 = v_0^2 + 2 a \Delta x \implies 0^2 = 18^2 + 2 a (80) \]
          \[ 0 = 324 + 160 a \implies a = -\frac{324}{160} = -2{,}025\text{ m/s}^2 \]
          El módulo de la aceleración de frenado es \(|a| = 2{,}025\text{ m/s}^2\).<br><br>
          <strong>Paso 2: Aplicación de la Segunda Ley de Newton en el eje horizontal:</strong><br>
          La única fuerza en la dirección del movimiento es la fuerza de rozamiento cinético opuesta al deslizamiento:
          \[ \Sigma F_x = -f_k = m a \implies -\mu_k N = m a \]
          En el eje vertical, como el disco no levanta vuelo ni se hunde: \(N = P = mg\). Sustituyendo:
          \[ -\mu_k m g = m a \implies \mu_k g = |a| \implies \mu_k = \frac{|a|}{g} \]
          \[ \mu_k = \frac{2{,}025\text{ m/s}^2}{9{,}8\text{ m/s}^2} \approx 0{,}207 \quad \left(\text{o } \frac{2{,}025}{10} \approx 0{,}202\right) \]
          <em>¡Conclusión fundamental!</em> La masa \(m\) se simplifica en ambos lados de la ecuación, por lo que la opción D es una falsa creencia: el frenado por rozamiento en superficie horizontal depende exclusivamente de la velocidad, la distancia y la aceleración de la gravedad.
        </div>
      </div>

      <!-- Pregunta 5: Fuerzas Perpendiculares -->
      <div class="psd-bank-item" id="bank-q-5">
        <div class="psd-quiz-header">
          <span class="psd-bank-badge">Álgebra Vectorial y 2.ª Ley · Ejercicio 45d</span>
          <span class="psd-quiz-status" id="bank-status-5">○ Sin responder</span>
        </div>
        <h3>5. Fuerzas Perpendiculares Actuando sobre una Misma Masa</h3>
        <div class="psd-quiz-statement">
          Sobre un cuerpo de masa \(m\) apoyado en una superficie horizontal lisa actúa una fuerza horizontal \(\vec{F}_1\), comunicándole una aceleración de módulo \(a_0\). Si ahora se le aplica simultáneamente una segunda fuerza horizontal \(\vec{F}_2\) del <strong>mismo módulo</strong> que la primera (\(|\vec{F}_2| = |\vec{F}_1|\)), pero formando un <strong>ángulo recto de \(90^\circ\)</strong> con ella, ¿cuál será el módulo de la <strong>nueva aceleración resultante (\(a\))</strong>?
        </div>
        <div class="psd-quiz-options" data-qid="5">
          <label class="psd-quiz-option">
            <input type="radio" name="bank-opt-5" value="A">
            <span class="opt-letter">A</span>
            <span class="opt-text">\(a = 2\,a_0\)</span>
          </label>
          <label class="psd-quiz-option">
            <input type="radio" name="bank-opt-5" value="B">
            <span class="opt-letter">B</span>
            <span class="opt-text">\(a = \sqrt{2}\,a_0 \approx 1{,}41\,a_0\)</span>
          </label>
          <label class="psd-quiz-option">
            <input type="radio" name="bank-opt-5" value="C">
            <span class="opt-letter">C</span>
            <span class="opt-text">\(a = a_0\)</span>
          </label>
          <label class="psd-quiz-option">
            <input type="radio" name="bank-opt-5" value="D">
            <span class="opt-letter">D</span>
            <span class="opt-text">\(a = \frac{a_0}{\sqrt{2}} \approx 0{,}71\,a_0\)</span>
          </label>
        </div>
        <div class="psd-quiz-actions">
          <button class="psd-btn psd-btn-primary psd-btn-check-quiz" data-qid="5">Comprobar Respuesta</button>
          <button class="psd-btn psd-btn-outline psd-btn-retry-quiz" data-qid="5" style="display: none;">Reintentar ↺</button>
        </div>
        <div id="bank-fb-5" class="psd-feedback"></div>
        <div id="bank-sol-5" class="psd-solution-box" style="display: none;">
          <div class="psd-solution-title">Retroalimentación y Demostración Vectorial:</div>
          <strong>• Por qué la Opción B es la CORRECTA:</strong><br>
          Cuando actuaba únicamente la primera fuerza de módulo \(F\):
          \[ a_0 = \frac{F}{m} \implies F = m a_0 \]
          Al actuar dos fuerzas perpendiculares entre sí (\(\theta = 90^\circ\)), la suma vectorial de las fuerzas forma los catetos de un triángulo rectángulo. El módulo de la fuerza neta resultante se halla mediante el Teorema de Pitágoras:
          \[ |\Sigma \vec{F}| = \sqrt{F_1^2 + F_2^2} = \sqrt{F^2 + F^2} = \sqrt{2 F^2} = \sqrt{2}\,F \]
          Aplicando la 2.ª Ley de Newton (\(\Sigma\vec{F} = m\vec{a}\)):
          \[ a = \frac{|\Sigma \vec{F}|}{m} = \frac{\sqrt{2}\,F}{m} = \sqrt{2}\left(\frac{F}{m}\right) = \sqrt{2}\,a_0 \approx 1{,}414\,a_0 \]
          <br>
          <em>¡Cuidado con la suma escalar!</em> La opción A (\(2a_0\)) solo sería correcta si ambas fuerzas tuvieran la misma dirección y el mismo sentido (\(\theta = 0^\circ\)). En física formal las fuerzas son vectores, no escalares.
        </div>
      </div>

      <!-- Pregunta 6: Polea en el Techo y Reacción del Suelo -->
      <div class="psd-bank-item" id="bank-q-6">
        <div class="psd-quiz-header">
          <span class="psd-bank-badge">Cuerpos Vinculados y Reacción · Ejercicio 46</span>
          <span class="psd-quiz-status" id="bank-status-6">○ Sin responder</span>
        </div>
        <h3>6. Levantamiento con Polea en Techo y Reacción del Suelo</h3>
        <div class="psd-quiz-statement">
          Una deportista de masa \(m_1 = 65\text{ kg}\) de pie sobre el suelo desea levantar una pesa de masa \(m_2 = 60\text{ kg}\) mediante una cuerda inextensible que pasa por una polea ideal fija en el techo. Si tira de la cuerda de modo que la pesa suba con una aceleración constante hacia arriba de \(a = 0{,}5\text{ m/s}^2\) (\(g = 9{,}8\text{ m/s}^2\)):
          ¿Cuál es la tensión \(T\) en la cuerda y qué fuerza Normal \(N\) ejerce el suelo sobre los pies de la deportista?
        </div>
        <div class="psd-quiz-options" data-qid="6">
          <label class="psd-quiz-option">
            <input type="radio" name="bank-opt-6" value="A">
            <span class="opt-letter">A</span>
            <span class="opt-text">Tensión \(T = 618\text{ N}\); Normal del suelo \(N = 19\text{ N}\) (la deportista permanece apoyada sobre el suelo).</span>
          </label>
          <label class="psd-quiz-option">
            <input type="radio" name="bank-opt-6" value="B">
            <span class="opt-letter">B</span>
            <span class="opt-text">Tensión \(T = 588\text{ N}\); Normal del suelo \(N = 0\text{ N}\) (la deportista se despega y queda suspendida en el aire).</span>
          </label>
          <label class="psd-quiz-option">
            <input type="radio" name="bank-opt-6" value="C">
            <span class="opt-letter">C</span>
            <span class="opt-text">Tensión \(T = 650\text{ N}\); la deportista no puede lograr esa aceleración porque la pesa pesa más que ella.</span>
          </label>
          <label class="psd-quiz-option">
            <input type="radio" name="bank-opt-6" value="D">
            <span class="opt-letter">D</span>
            <span class="opt-text">Tensión \(T = 30\text{ N}\); Normal del suelo \(N = 637\text{ N}\).</span>
          </label>
        </div>
        <div class="psd-quiz-actions">
          <button class="psd-btn psd-btn-primary psd-btn-check-quiz" data-qid="6">Comprobar Respuesta</button>
          <button class="psd-btn psd-btn-outline psd-btn-retry-quiz" data-qid="6" style="display: none;">Reintentar ↺</button>
        </div>
        <div id="bank-fb-6" class="psd-feedback"></div>
        <div id="bank-sol-6" class="psd-solution-box" style="display: none;">
          <div class="psd-solution-title">Retroalimentación y Resolución Paso a Paso:</div>
          <strong>• Por qué la Opción A es la CORRECTA:</strong><br>
          <strong>1. DCL y 2.ª Ley para la Pesa (\(m_2 = 60\text{ kg}\), aceleración \(a = 0{,}5\text{ m/s}^2\) hacia arriba):</strong><br>
          Las fuerzas sobre la pesa son la Tensión \(T\) hacia arriba y su peso \(P_2\) hacia abajo:
          \[ \Sigma F_{2y} = T - P_2 = m_2 a \implies T = m_2 g + m_2 a = m_2(g + a) \]
          \[ T = 60\text{ kg} \cdot (9{,}8 + 0{,}5)\text{ m/s}^2 = 60 \cdot 10{,}3 = 618\text{ N} \quad (\text{o } 630\text{ N con } g = 10\text{ m/s}^2) \]
          <br>
          <strong>2. DCL y Equilibrio para la Deportista (\(m_1 = 65\text{ kg}\)):</strong><br>
          Fuerzas verticales que actúan sobre la persona:
          <ul>
            <li>Su propio peso hacia abajo: \(P_1 = m_1 g = 65\text{ kg} \cdot 9{,}8\text{ m/s}^2 = 637\text{ N}\).</li>
            <li>La tensión de la cuerda tirando de sus manos hacia arriba: \(T = 618\text{ N}\).</li>
            <li>La fuerza Normal que el piso ejerce sobre sus pies hacia arriba: \(N\).</li>
          </ul>
          Planteando el equilibrio vertical (\(\Sigma F_{1y} = 0\)):
          \[ N + T - P_1 = 0 \implies N = P_1 - T = 637\text{ N} - 618\text{ N} = 19\text{ N} \]
          <br>
          <strong>Conclusión física:</strong> Como \(N > 0\), la persona <strong>no se despega del piso</strong>. Sigue apoyada, sintiendo una fuerza de apoyo residual de solo \(19\text{ N}\) (equivalente a sentir el peso de aproximadamente \(2\text{ kg}\)).
        </div>
    </div>
  </section>

  <!-- =========================================================================
       MÓDULO 8: EVALUACIÓN ESCRITA (ENTREGABLE EN PAPEL)
       ========================================================================= -->
  <section id="tab-mod8" class="psd-tab-content">
    <div class="psd-card no-print" style="margin-bottom: 1rem; border-color: #0284c7; background: #f0f9ff;">
      <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <div>
          <h2 style="color: #0369a1; margin: 0 0 0.25rem 0;">📝 Evaluación Escrita para Entregar en Papel</h2>
          <p style="margin: 0; font-size: 0.92rem; color: #334155;">Esta sección contiene <strong>únicamente los enunciados</strong> de la evaluación. Está diseñada para resolver en hoja y entregar al docente sin soluciones automáticas en pantalla.</p>
        </div>
        <button id="psd-btn-print-exam" class="psd-btn psd-btn-print">🖨️ Imprimir / Guardar como PDF</button>
      </div>
    </div>

    <!-- Hoja de Examen Imprimible Formal -->
    <div class="psd-exam-paper">
      <div class="psd-exam-header-school">
        <div class="psd-exam-title-block">
          <h3>Evaluación escrita · Segunda Ley de Newton</h3>
          <p>Física · Bachillerato Diversificado (Plan 94 / 2.° EMS)</p>
        </div>
        <div class="psd-exam-student-box">
          <div><strong>Alumno/a:</strong> _________________________________</div>
          <div style="margin-top: 0.4rem;"><strong>Grupo:</strong> 5.º ____ &nbsp;&nbsp;&nbsp; <strong>Fecha:</strong> ____ / ____ / ________</div>
        </div>
      </div>

      <!-- Problema 1 -->
      <div class="psd-exam-prob">
        <div class="psd-exam-prob-num">Problema 1</div>
        <div class="psd-exam-prob-body">
          <div class="psd-exam-prob-text">
            El muchacho de la <strong>figura 1</strong> tira de un carro cargado con \(100\text{ kg}\) de masa total. Aplica una fuerza constante de \(100\text{ N}\) a lo largo de la cuerda, a \(30^\circ\) con la horizontal.<br>
            Sin tener en cuenta el rozamiento, calcula y representa todas las fuerzas y la fuerza neta que actúa sobre el carro.<br>
            <em>(Por cierto, el carrito pesa demasiado para poder levantarlo del suelo, no se preocupe por esa posibilidad).</em>
          </div>
          <div class="psd-exam-prob-fig">
            <img src="<?php echo esc_url(PSD_URL . 'assets/images/evaluacion/figura1-carro.png'); ?>" alt="Figura 1 - Muchacho tirando de un carro con fuerza a 30 grados" />
          </div>
        </div>
      </div>

      <!-- Problema 2 -->
      <div class="psd-exam-prob">
        <div class="psd-exam-prob-num">Problema 2</div>
        <div class="psd-exam-prob-body">
          <div class="psd-exam-prob-text">
            Calcule y represente la aceleración del sistema y la tensión de las cuerdas (ver <strong>figura 2</strong>). No tenga en cuenta la fricción, ni la masa de las poleas.<br>
            <strong>Datos:</strong> \(m_1 = 130\text{ kg}\); \(m_2 = 180\text{ kg}\).
          </div>
          <div class="psd-exam-prob-fig">
            <img src="<?php echo esc_url(PSD_URL . 'assets/images/evaluacion/figura2-poleas.png'); ?>" alt="Figura 2 - Sistema de poleas con masas m1 y m2" />
          </div>
        </div>
      </div>

      <!-- Problema 3 -->
      <div class="psd-exam-prob">
        <div class="psd-exam-prob-num">Problema 3</div>
        <div class="psd-exam-prob-body">
          <div class="psd-exam-prob-text">
            Determine la fuerza neta de compresión que actúa sobre la rótula como resultado de la acción del músculo cuádriceps (\(\vec{F}_M\) hacia arriba) y el tendón inferior (\(\vec{F}_t\) hacia abajo), que se ven en la <strong>figura 3</strong>.<br>
            Suponga que el ángulo entre el grupo muscular y el tendón es de \(160^\circ\) y que la pierna se dobla en forma simétrica, de tal modo que \(F_M = 100\text{ N}\) y \(F_t = 100\text{ N}\).<br>
            ¿Qué sucede con la fuerza neta a medida que la rodilla se dobla cada vez más?
          </div>
          <div class="psd-exam-prob-fig">
            <img src="<?php echo esc_url(PSD_URL . 'assets/images/evaluacion/figura3-rotula.png'); ?>" alt="Figura 3 - Fuerzas en la rótula y tendón" />
          </div>
        </div>
      </div>

      <!-- Problema 4 -->
      <div class="psd-exam-prob">
        <div class="psd-exam-prob-num">Problema 4</div>
        <div class="psd-exam-prob-text">
          Un auto desciende por una carretera que se encuentra inclinada \(20^\circ\) con respecto a la horizontal y sobre él actúa una fuerza de módulo igual a \(1000\text{ N}\). Si el valor de la fuerza de rozamiento es de \(1470\text{ N}\) y la masa del auto es de \(800\text{ kg}\):<br>
          <strong>a)</strong> Calcula y representa todas las fuerzas que actúan sobre el auto, y determina el valor del coeficiente de rozamiento.<br>
          <strong>b)</strong> Calcula y representa la fuerza neta y la aceleración del auto.
        </div>
      </div>

      <!-- Problema 5 -->
      <div class="psd-exam-prob">
        <div class="psd-exam-prob-num">Problema 5</div>
        <div class="psd-exam-prob-text">
          Un bloque de \(1{,}5\text{ kg}\) desciende por un plano inclinado \(30^\circ\). El coeficiente de rozamiento entre el piso y el bloque es de \(0{,}4\):<br>
          <strong>a)</strong> Represente todas las fuerzas que actúan sobre el bloque.<br>
          <strong>b)</strong> Calcule y represente la fuerza neta.<br>
          <strong>c)</strong> Halle y represente la aceleración del sistema.
        </div>
      </div>

      <!-- Problema 6 -->
      <div class="psd-exam-prob">
        <div class="psd-exam-prob-num">Problema 6</div>
        <div class="psd-exam-prob-body">
          <div class="psd-exam-prob-text">
            Un bloque de masa \(500\text{ g}\), es acelerado hacia la derecha por una fuerza horizontal \(\vec{F}\) de módulo \(3{,}0\text{ N}\). La aceleración que este adquiere, es horizontal hacia la derecha y su módulo es \(4{,}0\text{ m/s}^2\).<br>
            Calcula y representa la fuerza neta y todas las fuerzas que actúan sobre el bloque.
          </div>
          <div class="psd-exam-prob-fig">
            <img src="<?php echo esc_url(PSD_URL . 'assets/images/evaluacion/figura6-bloque.png'); ?>" alt="Problema 6 - Bloque con fuerza horizontal F" />
          </div>
        </div>
      </div>

      <!-- Problema 7 -->
      <div class="psd-exam-prob">
        <div class="psd-exam-prob-num">Problema 7</div>
        <div class="psd-exam-prob-body">
          <div class="psd-exam-prob-text">
            La tabla muestra los valores de la Fuerza Neta que actúa sobre un cuerpo y su correspondiente aceleración:<br>
            <strong>a)</strong> Completa la tabla.<br>
            <strong>b)</strong> Grafica \(F = f(a)\).<br>
            <strong>c)</strong> ¿Qué significado físico tiene la pendiente del gráfico?<br>
            <strong>d)</strong> Determina el valor de la pendiente.

            <div style="margin: 0.75rem 0; overflow-x: auto;">
              <table class="psd-exam-table">
                <thead>
                  <tr>
                    <th colspan="2" style="text-align: center; font-style: italic;">\(F = f(a)\)</th>
                  </tr>
                  <tr style="background: #f8fafc;">
                    <th>\(F_N\text{ (N)}\)</th>
                    <th>\(a\text{ (m/s}^2\text{)}\)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>2,0</td>
                    <td>0,5</td>
                  </tr>
                  <tr>
                    <td>3,6</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>1,2</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>1,3</td>
                  </tr>
                  <tr>
                    <td>6,0</td>
                    <td>&nbsp;</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="psd-exam-prob-fig">
            <img src="<?php echo esc_url(PSD_URL . 'assets/images/evaluacion/figura7-tabla.png'); ?>" alt="Problema 7 - Tabla original F = f(a)" />
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
