/**
 * Entorno Didáctico de Dinámica - 5.º Año Científico (Bachillerato Uruguay)
 * Versión 2.1.0 - Actualizada con diagramas SVG de alta resolución sin superposición,
 * DCLs individuales por caja, laboratorio de frenado dinámico y banco de ejercicios.
 */

(() => {
  'use strict';

  const G_DEFAULT = 9.8; // m/s^2
  // Formato numérico rioplatense: coma decimal y punto como separador de miles
  function fmt(x, decimals) {
    const [ent, dec] = Math.abs(x).toFixed(decimals).split('.');
    const miles = ent.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    const signo = (x < 0 && Number(Math.abs(x).toFixed(decimals)) !== 0) ? '-' : '';
    return signo + miles + (dec !== undefined ? ',' + dec : '');
  }

  const STORAGE_KEY = 'psd_fisica_5to_state_v2';

  let state = {
    score: 0,
    solved: {},
    activeTab: 'mod1',
    activeProb: 1
  };

  /* ==========================================================================
     CARGA Y PERSISTENCIA DE ESTADO
     ========================================================================== */
  function loadState() {
    try {
      const saved = localStorage.getItem(STORAGE_KEY);
      if (saved) {
        state = Object.assign(state, JSON.parse(saved));
      }
    } catch (e) {
      console.warn('No se pudo acceder a localStorage:', e);
    }
    updateScoreUI();
  }

  function saveState() {
    try {
      localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
    } catch (e) {
      console.warn('Error al guardar en localStorage:', e);
    }
  }

  function addScore(points, key) {
    if (!state.solved[key]) {
      state.solved[key] = true;
      state.score = Math.min(100, state.score + points);
      saveState();
      updateScoreUI();
      return true;
    }
    return false;
  }

  function updateScoreUI() {
    const scoreNum = document.getElementById('psd-score-val');
    const barFill = document.getElementById('psd-progress-fill');
    if (scoreNum) scoreNum.textContent = state.score;
    if (barFill) barFill.style.width = state.score + '%';

    // Marcar problemas resueltos en el taller
    for (let i = 1; i <= 8; i++) {
      const btn = document.getElementById('psd-pbtn-' + i);
      if (btn) {
        const icon = btn.querySelector('.status-icon');
        if (state.solved['prob_' + i]) {
          btn.classList.add('solved');
          if (icon) icon.textContent = '✓';
        } else {
          btn.classList.remove('solved');
          if (icon) icon.textContent = '○';
        }
      }
    }
  }

  /* ==========================================================================
     RENDERIZADO MATEMÁTICO (KaTeX con fallback vectorial)
     ========================================================================== */
  function renderMath(container) {
    const root = container || document.getElementById('psd-app-root');
    if (!root) return;

    if (window.renderMathInElement) {
      try {
        window.renderMathInElement(root, {
          delimiters: [
            { left: '$$', right: '$$', display: true },
            { left: '$', right: '$', display: false },
            { left: '\\[', right: '\\]', display: true },
            { left: '\\(', right: '\\)', display: false }
          ],
          throwOnError: false
        });
        return;
      } catch (err) {
        console.warn('Error en renderMathInElement:', err);
      }
    }

    if (!window.__psdMathRetried) {
      window.__psdMathRetried = true;
      setTimeout(() => renderMath(root), 600);
    }
  }

  function checkTolerance(valInput, target1, target2, tolPercent = 0.05) {
    const txt = String(valInput).trim();
    const num = parseFloat(txt.includes(',') ? txt.replace(/\./g, '').replace(',', '.') : txt);
    if (isNaN(num)) return false;

    const check = (target) => {
      const tol = Math.max(0.18, Math.abs(target) * tolPercent);
      return Math.abs(num - target) <= tol;
    };

    if (check(target1)) return true;
    if (target2 !== undefined && check(target2)) return true;
    return false;
  }

  /* ==========================================================================
     UTILITARIO: BADGES VECTORIALES SVG RIGUROSOS Y SIN GLYPHS DEFECTUOSOS
     ========================================================================== */
  /**
   * Genera una etiqueta SVG con fondo blanco y vector overhead flecha auténtico.
   * Elimina cualquier carácter combinatorio (\u20D7) que produzca cajas rotas.
   */
  function svgBadge(cx, cy, symbol, sub = '', isVector = true, valStr = '', color = '#2563eb', borderColor = null, format = 'parens') {
    const border = borderColor || color;
    const subText = sub ? sub : '';
    let valPart = '';
    if (valStr) {
      if (format === 'eq') {
        valPart = ` = ${valStr}`;
      } else {
        valPart = ` (${valStr})`;
      }
    }
    const fullTextLen = symbol.length + subText.length * 0.7 + valPart.length;
    const width = Math.max(70, Math.round(18 + fullTextLen * 7.4));
    const height = 24;
    const rx = Math.round(cx - width / 2);
    const ry = Math.round(cy - height / 2);

    let arrowMarkup = '';
    const symStartX = rx + 9;
    if (isVector) {
      const symW = symbol === 'f' ? 7 : (symbol === 'N' ? 10 : (symbol === 'T' ? 8 : 9));
      const arrY = ry + 4.5;
      arrowMarkup = `
        <line x1="${symStartX}" y1="${arrY}" x2="${symStartX + symW}" y2="${arrY}" stroke="${color}" stroke-width="1.3" stroke-linecap="round" />
        <polyline points="${symStartX + symW - 2.5},${arrY - 2.5} ${symStartX + symW},${arrY} ${symStartX + symW - 2.5},${arrY + 2.5}" fill="none" stroke="${color}" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" />
      `;
    }

    const subMarkup = sub ? `<tspan font-size="9" dy="2">${sub}</tspan><tspan font-size="12" dy="-2">` : '';
    const subClose = sub ? `</tspan>` : '';

    return `
      <g class="psd-badge-group">
        <rect x="${rx}" y="${ry}" width="${width}" height="${height}" rx="5" fill="#ffffff" stroke="${border}" stroke-width="1.5" filter="drop-shadow(0 1px 2px rgba(0,0,0,0.08))" />
        ${arrowMarkup}
        <text x="${symStartX}" y="${ry + 16.5}" font-family="system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif" font-size="12" font-weight="700" fill="${color}">
          ${symbol}${subMarkup}${subClose}${valPart}
        </text>
      </g>
    `;
  }

  /* ==========================================================================
     SIMULADOR 1: DCL Y FUERZA OBLICUA (AMPLIADO Y DESPEJADO)
     ========================================================================== */
  function initSim1() {
    const mInput = document.getElementById('sim1-m');
    const fInput = document.getElementById('sim1-f');
    const aInput = document.getElementById('sim1-angle');
    const svg = document.getElementById('sim1-svg');

    if (!mInput || !fInput || !aInput || !svg) return;

    function update() {
      const m = parseFloat(mInput.value);
      const F = parseFloat(fInput.value);
      const angleDeg = parseFloat(aInput.value);
      const angleRad = (angleDeg * Math.PI) / 180;

      document.getElementById('sim1-m-val').textContent = fmt(m, 1) + ' kg';
      document.getElementById('sim1-f-val').textContent = fmt(F, 0) + ' N';
      document.getElementById('sim1-angle-val').textContent = fmt(angleDeg, 0) + '°';

      const P = m * G_DEFAULT;
      const Fx = F * Math.cos(angleRad);
      const Fy = F * Math.sin(angleRad);

      let N = P - Fy;
      let despega = false;
      if (N < 0.05) {
        N = 0;
        despega = true;
      }
      const ax = Fx / m;

      // Actualizar lecturas del panel
      document.getElementById('sim1-out-p').textContent = fmt(P, 1) + ' N';
      document.getElementById('sim1-out-fx').textContent = fmt(Fx, 1) + ' N';
      document.getElementById('sim1-out-fy').textContent = fmt(Fy, 1) + ' N';
      document.getElementById('sim1-out-n').textContent = fmt(N, 1) + ' N' + (despega ? ' (¡Se despega!)' : '');
      document.getElementById('sim1-out-a').textContent = fmt(ax, 2) + ' m/s²';

      // Parámetros de dibujo SVG despejado (viewBox 0 0 540 360)
      const cx = 190, cy = 195;
      const boxW = 104, boxH = 64;
      const groundY = cy + boxH / 2; // 227

      let svgHtml = `
        <defs>
          <marker id="arr-green" viewBox="0 0 10 10" refX="7" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse">
            <path d="M 0 1.5 L 8 5 L 0 8.5 z" fill="#16a34a" />
          </marker>
          <marker id="arr-red" viewBox="0 0 10 10" refX="7" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse">
            <path d="M 0 1.5 L 8 5 L 0 8.5 z" fill="#dc2626" />
          </marker>
          <marker id="arr-blue" viewBox="0 0 10 10" refX="7" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse">
            <path d="M 0 1.5 L 8 5 L 0 8.5 z" fill="#2563eb" />
          </marker>
          <pattern id="hatch1" width="10" height="10" patternTransform="rotate(45 0 0)" patternUnits="userSpaceOnUse">
            <line x1="0" y1="0" x2="0" y2="10" stroke="#cbd5e1" stroke-width="2" />
          </pattern>
        </defs>

        <!-- Suelo horizontal amplio -->
        <line x1="15" y1="${groundY}" x2="525" y2="${groundY}" stroke="#64748b" stroke-width="3" />
        <rect x="15" y="${groundY}" width="510" height="18" fill="url(#hatch1)" />

        <!-- Bloque de masa m -->
        <rect x="${cx - boxW/2}" y="${cy - boxH/2}" width="${boxW}" height="${boxH}" rx="5" fill="#f8fafc" stroke="#1e293b" stroke-width="2.5" />
        <!-- Masa a la izquierda del bloque, fuera de la zona que cruzan los vectores -->
        <text x="${cx - boxW/2 - 10}" y="${cy + 5}" text-anchor="end" font-size="13" font-weight="bold" fill="#1e293b">m = ${fmt(m, 1)} kg</text>

        <!-- Centro de masa (punto de aplicación) -->
        <circle cx="${cx}" cy="${cy}" r="4" fill="#0f172a" />
      `;

      // Vector Peso P hacia abajo (atraviesa el suelo con longitud clara)
      const pLen = Math.min(125, Math.max(80, 75 + (P / 245) * 50));
      svgHtml += `
        <line x1="${cx}" y1="${cy}" x2="${cx}" y2="${cy + pLen}" stroke="#dc2626" stroke-width="3" marker-end="url(#arr-red)" />
        ${svgBadge(cx, cy + pLen + 18, 'P', '', true, fmt(P, 0) + ' N', '#dc2626', '#fca5a5')}
      `;

      // Vector Normal N hacia arriba
      if (!despega) {
        const nLen = Math.min(135, Math.max(75, 70 + (N / 245) * 65));
        svgHtml += `
          <line x1="${cx}" y1="${cy}" x2="${cx}" y2="${cy - nLen}" stroke="#2563eb" stroke-width="3" marker-end="url(#arr-blue)" />
          ${svgBadge(cx, cy - nLen - 18, 'N', '', true, fmt(N, 0) + ' N', '#2563eb', '#93c5fd')}
        `;
      } else {
        svgHtml += `
          ${svgBadge(cx, cy - boxH/2 - 20, '¡Se despega!', '', false, 'N = 0 N', '#ea580c', '#fdba74')}
        `;
      }

      // Vector Fuerza aplicada F
      if (F > 0) {
        const fLen = Math.min(155, Math.max(90, 85 + (F / 150) * 70));
        const fxEnd = cx + fLen * Math.cos(angleRad);
        const fyEnd = cy - fLen * Math.sin(angleRad);

        svgHtml += `
          <!-- Vector F principal -->
          <line x1="${cx}" y1="${cy}" x2="${fxEnd}" y2="${fyEnd}" stroke="#16a34a" stroke-width="3.5" marker-end="url(#arr-green)" />
          
          <!-- Badge F en la punta de la flecha siguiendo su dirección con holgura -->
          ${svgBadge(
            fxEnd + 48 * Math.cos(angleRad),
            fyEnd - 48 * Math.sin(angleRad),
            'F', '', true, fmt(F, 0) + ' N', '#15803d', '#86efac'
          )}

          <!-- Componentes punteadas Fx y Fy -->
          <line x1="${cx}" y1="${cy}" x2="${fxEnd}" y2="${cy}" stroke="#16a34a" stroke-width="1.8" stroke-dasharray="5,4" />
          <line x1="${fxEnd}" y1="${cy}" x2="${fxEnd}" y2="${fyEnd}" stroke="#16a34a" stroke-width="1.8" stroke-dasharray="5,4" />
          
          <!-- Badge Fx: debajo del suelo si F apunta hacia arriba (y arriba si apunta hacia abajo), unido por una guía punteada -->
          <line x1="${fxEnd}" y1="${cy}" x2="${fxEnd}" y2="${angleDeg >= 0 ? groundY + 22 : cy - 28}" stroke="#86efac" stroke-width="1.2" stroke-dasharray="2,3" />
          ${svgBadge(fxEnd, angleDeg >= 0 ? groundY + 34 : cy - 40, 'F', 'x', false, fmt(Fx, 0) + ' N', '#166534', '#bbf7d0', 'eq')}

          <!-- Badge Fy a la derecha de la proyección vertical -->
          ${svgBadge(fxEnd + 48, (cy + fyEnd) / 2 + (angleDeg >= 0 ? 22 : -22), 'F', 'y', false, fmt(Fy, 0) + ' N', '#166534', '#bbf7d0', 'eq')}
        `;

        // Arco de ángulo alfa (radio mayor que el semiancho del bloque para no pisarlo)
        if (Math.abs(angleDeg) >= 4) {
          const arcR = 64;
          const arcEndRad = -angleRad;
          const ax = cx + arcR * Math.cos(arcEndRad);
          const ay = cy + arcR * Math.sin(arcEndRad);

          svgHtml += `
            <path d="M ${cx + arcR} ${cy} A ${arcR} ${arcR} 0 0 ${angleDeg > 0 ? 0 : 1} ${ax} ${ay}" fill="none" stroke="#475569" stroke-width="2" />
            <text x="${cx + arcR + 8}" y="${cy + (angleDeg > 0 ? 17 : -7)}" font-size="12" font-weight="700" fill="#334155" stroke="#ffffff" stroke-width="3" paint-order="stroke">α = ${fmt(angleDeg, 0)}°</text>
          `;
        }
      }

      svg.innerHTML = svgHtml;
    }

    mInput.addEventListener('input', update);
    fInput.addEventListener('input', update);
    aInput.addEventListener('input', update);
    update();
  }

  /* ==========================================================================
     SIMULADOR 2: ROZAMIENTO ESTÁTICO VS. CINÉTICO 
     ========================================================================== */
  function initSim2() {
    const mInput = document.getElementById('sim2-m');
    const usInput = document.getElementById('sim2-us');
    const ukInput = document.getElementById('sim2-uk');
    const fInput = document.getElementById('sim2-f');
    const svg = document.getElementById('sim2-svg');

    if (!mInput || !usInput || !ukInput || !fInput || !svg) return;

    function update() {
      const m = parseFloat(mInput.value);
      const us = parseFloat(usInput.value);
      const uk = parseFloat(ukInput.value);
      const F = parseFloat(fInput.value);

      document.getElementById('sim2-m-val').textContent = fmt(m, 0) + ' kg';
      document.getElementById('sim2-us-val').textContent = fmt(us, 2);
      document.getElementById('sim2-uk-val').textContent = fmt(uk, 2);
      document.getElementById('sim2-f-val').textContent = fmt(F, 0) + ' N';

      const N = m * G_DEFAULT;
      const fsMax = us * N;
      const fk = uk * N;

      let froz = 0;
      let estado = '';
      let a = 0;

      if (F < fsMax) {
        froz = F;
        estado = 'En reposo (Equilibrio estático: ΣF = 0, fs equilibra a F)';
        a = 0;
      } else if (Math.abs(F - fsMax) < 0.5) {
        froz = fsMax;
        estado = 'Movimiento inminente (Umbral máximo de rozamiento estático fs,máx)';
        a = 0;
      } else {
        froz = fk;
        a = (F - fk) / m;
        estado = `En movimiento acelerado (MRUA con aceleración a = ${fmt(a, 2)} m/s²)`;
      }

      document.getElementById('sim2-out-fsmax').textContent = fmt(fsMax, 1) + ' N';
      document.getElementById('sim2-out-fk').textContent = fmt(fk, 1) + ' N';
      document.getElementById('sim2-out-froz').textContent = fmt(froz, 1) + ' N';
      document.getElementById('sim2-out-a').textContent = fmt(a, 2) + ' m/s²';
      document.getElementById('sim2-out-estado').textContent = estado;

      // Gráfica de Rozamiento SVG
      const padL = 60, padB = 40, w = 380, h = 230;
      const maxF_plot = Math.max(300, fsMax * 1.5);
      const maxFroz_plot = Math.max(200, fsMax * 1.3);

      const x2pix = (val) => padL + (val / maxF_plot) * (w - padL - 25);
      const y2pix = (val) => (h - padB) - (val / maxFroz_plot) * (h - padB - 25);

      const px0 = x2pix(0), py0 = y2pix(0);
      const px_fsmax = x2pix(fsMax);
      const py_fsmax = y2pix(fsMax);
      const py_fk = y2pix(fk);
      const px_end = x2pix(maxF_plot);

      const curX = x2pix(F);
      const curY = y2pix(froz);

      svg.innerHTML = `
        <!-- Ejes cartesianos -->
        <line x1="${padL}" y1="${h - padB}" x2="${w - 18}" y2="${h - padB}" stroke="#475569" stroke-width="2.5" />
        <polygon points="${w - 8},${h - padB} ${w - 20},${h - padB - 6} ${w - 20},${h - padB + 6}" fill="#475569" />
        <line x1="${padL}" y1="${h - padB}" x2="${padL}" y2="22" stroke="#475569" stroke-width="2.5" />
        <polygon points="${padL},10 ${padL - 6},22 ${padL + 6},22" fill="#475569" />
        <text x="${w - 8}" y="${h - padB + 24}" text-anchor="end" font-size="12" font-weight="bold" fill="#334155">F (N)</text>
        <text x="${padL + 12}" y="20" font-size="12" font-weight="bold" fill="#334155">f_roz (N)</text>

        <!-- Zona Estática: Recta fs = F a 45° -->
        <line x1="${px0}" y1="${py0}" x2="${px_fsmax}" y2="${py_fsmax}" stroke="#2563eb" stroke-width="3.5" />
        
        <!-- Salto de ruptura hacia fk -->
        <line x1="${px_fsmax}" y1="${py_fsmax}" x2="${px_fsmax}" y2="${py_fk}" stroke="#94a3b8" stroke-width="2" stroke-dasharray="4,4" />

        <!-- Zona Cinética: Meseta horizontal fk = uk*N -->
        <line x1="${px_fsmax}" y1="${py_fk}" x2="${px_end}" y2="${py_fk}" stroke="#dc2626" stroke-width="3.5" />

        <!-- Etiquetas de referencia con badges -->
        <text x="${px_fsmax}" y="${h - padB + 16}" font-size="11" text-anchor="middle" font-weight="bold" fill="#2563eb">fs,máx (${fmt(fsMax, 0)}N)</text>
        <line x1="${padL}" y1="${py_fk}" x2="${px_fsmax}" y2="${py_fk}" stroke="#cbd5e1" stroke-width="1.5" stroke-dasharray="3,3" />
        <text x="${padL - 8}" y="${py_fk + 4}" font-size="11" text-anchor="end" font-weight="bold" fill="#dc2626">fk (${fmt(fk, 0)}N)</text>

        <!-- Indicador interactivo actual -->
        <circle cx="${curX}" cy="${curY}" r="6.5" fill="#16a34a" stroke="#ffffff" stroke-width="2.5" />
        <line x1="${curX}" y1="${curY}" x2="${curX}" y2="${h - padB}" stroke="#16a34a" stroke-width="1.8" stroke-dasharray="3,3" />
        <g transform="translate(${curX - 45}, ${curY - 26})">
          <rect x="0" y="0" width="90" height="20" rx="3" fill="#ffffff" stroke="#16a34a" stroke-width="1" />
          <text x="45" y="14" text-anchor="middle" font-size="11" font-weight="bold" fill="#15803d">(${fmt(F, 0)} N, ${fmt(froz, 0)} N)</text>
        </g>
      `;
    }

    mInput.addEventListener('input', update);
    usInput.addEventListener('input', update);
    ukInput.addEventListener('input', update);
    fInput.addEventListener('input', update);
    update();
  }

  /* ==========================================================================
     SIMULADOR 3: PLANO INCLINADO (AMPLIADO, BLOQUE GRANDE, SIN SUPERPOSICIONES)
     ========================================================================== */
  function initSim3() {
    const degInput = document.getElementById('sim3-deg');
    const mInput = document.getElementById('sim3-m');
    const ukInput = document.getElementById('sim3-uk');
    const svg = document.getElementById('sim3-svg');
    const btnAnim = document.getElementById('sim3-btn-anim');

    if (!degInput || !mInput || !ukInput || !svg) return;

    let animInterval = null;
    let animOffset = 0;

    function update() {
      const thetaDeg = parseFloat(degInput.value);
      const m = parseFloat(mInput.value);
      const uk = parseFloat(ukInput.value);
      const thetaRad = (thetaDeg * Math.PI) / 180;

      document.getElementById('sim3-deg-val').textContent = fmt(thetaDeg, 0) + '°';
      document.getElementById('sim3-m-val').textContent = fmt(m, 1) + ' kg';
      document.getElementById('sim3-uk-val').textContent = fmt(uk, 2);

      const P = m * G_DEFAULT;
      // Ejes rotados: x a lo largo del plano (hacia abajo), y perpendicular al plano
      const Px = P * Math.sin(thetaRad);
      const Py = P * Math.cos(thetaRad);
      const N = Py;
      const fk = uk * N;

      let a = 0;
      let regimen = '';
      if (thetaDeg === 0) {
        a = 0;
        regimen = 'Plano horizontal (reposo)';
      } else if (Px <= fk) {
        a = 0;
        regimen = 'No desliza / Equilibrio estático (Pₓ ≤ f_k)';
      } else {
        a = (Px - fk) / m;
        if (Math.abs(a) < 0.05) {
          regimen = 'Velocidad constante / MRU (Equilibrio dinámico tan θ ≈ μk)';
        } else {
          regimen = `Desciende acelerando (MRUA: a = ${fmt(a, 2)} m/s²)`;
        }
      }

      document.getElementById('sim3-out-px').textContent = fmt(Px, 1) + ' N';
      document.getElementById('sim3-out-py').textContent = fmt(Py, 1) + ' N';
      document.getElementById('sim3-out-n').textContent = fmt(N, 1) + ' N';
      document.getElementById('sim3-out-fk').textContent = fmt(fk, 1) + ' N';
      document.getElementById('sim3-out-a').textContent = fmt(a, 2) + ' m/s²';
      document.getElementById('sim3-out-reg').textContent = regimen;

      // Geometría SVG amplia (viewBox 0 0 560 360)
      const baseX = 40, baseY = 300;
      const rampaLen = 380;
      const apexX = baseX + rampaLen * Math.cos(thetaRad);
      const apexY = baseY - rampaLen * Math.sin(thetaRad);

      // Posición del bloque sobre la rampa (baja desde 0.42 hasta 0.82)
      const tPos = 0.42 + animOffset * 0.38;
      const bx = apexX - tPos * rampaLen * Math.cos(thetaRad);
      const by = apexY + tPos * rampaLen * Math.sin(thetaRad);

      const boxW = 80, boxH = 46;
      // Centro de masa en coordenadas globales
      const cmX = bx - (boxH / 2) * Math.sin(thetaRad);
      const cmY = by - (boxH / 2) * Math.cos(thetaRad);

      // Todos los vectores comparten la misma escala (px por newton), así Px y Py son las proyecciones reales de P
      const pLen = Math.min(125, Math.max(85, 80 + (P / 40) * 45));
      const k = pLen / P;
      const pxLen = Px * k;
      const pyLen = Py * k;
      const nLen = N * k;
      const fkLen = Math.max(fk * k, 12);

      // Puntas de vectores en coordenadas globales
      // Normal: apunta perpendicular a la rampa hacia el exterior (-sin θ, -cos θ)
      const nTipX = cmX - nLen * Math.sin(thetaRad);
      const nTipY = cmY - nLen * Math.cos(thetaRad);

      // Peso P: vertical hacia abajo (0, +1)
      const pTipX = cmX;
      const pTipY = cmY + pLen;

      // Py: perpendicular al plano, hacia adentro (+sin θ, +cos θ)
      const pyTipX = cmX + pyLen * Math.sin(thetaRad);
      const pyTipY = cmY + pyLen * Math.cos(thetaRad);

      // Px: a lo largo del plano, hacia abajo (-cos θ, +sin θ)
      const pparTipX = cmX - pxLen * Math.cos(thetaRad);
      const pparTipY = cmY + pxLen * Math.sin(thetaRad);

      // Rozamiento fk: hacia arriba de la rampa (+cos θ, -sin θ)
      const fkTipX = cmX + fkLen * Math.cos(thetaRad);
      const fkTipY = cmY - fkLen * Math.sin(thetaRad);

      let svgHtml = `
        <defs>
          <marker id="arr-m3-red" viewBox="0 0 10 10" refX="7" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse">
            <path d="M 0 1.5 L 8 5 L 0 8.5 z" fill="#dc2626" />
          </marker>
          <marker id="arr-m3-blue" viewBox="0 0 10 10" refX="7" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse">
            <path d="M 0 1.5 L 8 5 L 0 8.5 z" fill="#2563eb" />
          </marker>
          <marker id="arr-m3-orange" viewBox="0 0 10 10" refX="7" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse">
            <path d="M 0 1.5 L 8 5 L 0 8.5 z" fill="#ea580c" />
          </marker>
        </defs>

        <!-- Cuña de la rampa -->
        <polygon points="${baseX},${baseY} ${apexX},${baseY} ${apexX},${apexY}" fill="#e2e8f0" stroke="#475569" stroke-width="2.5" />
        <line x1="20" y1="${baseY}" x2="540" y2="${baseY}" stroke="#64748b" stroke-width="2.5" />

        <!-- Arco de ángulo theta con badge horizontal -->
        ${thetaDeg > 4 ? `
          <path d="M ${baseX + 60} ${baseY} A 60 60 0 0 0 ${baseX + 60 * Math.cos(thetaRad)} ${baseY - 60 * Math.sin(thetaRad)}" fill="none" stroke="#0f172a" stroke-width="2.5" />
          ${svgBadge(baseX + 75, baseY - 16, 'θ', '', false, fmt(thetaDeg, 0) + '°', '#0f172a', '#cbd5e1', 'eq')}
        ` : ''}

        <!-- Bloque rotado sobre la rampa -->
        <g transform="translate(${bx}, ${by}) rotate(${-thetaDeg})">
          <rect x="${-boxW/2}" y="${-boxH}" width="${boxW}" height="${boxH}" rx="4" fill="#ffffff" stroke="#1e293b" stroke-width="2.5" />
        </g>

        <!-- Masa del bloque (fuera del bloque para que no la crucen los vectores) -->
        <text x="24" y="32" font-size="14" font-weight="bold" fill="#1e293b">Bloque: m = ${fmt(m, 1)} kg</text>

        <!-- Centro de masa (punto común de origen) -->
        <circle cx="${cmX}" cy="${cmY}" r="4" fill="#0f172a" />

        <!-- Vector Normal N (perpendicular a la rampa hacia afuera) -->
        <line x1="${cmX}" y1="${cmY}" x2="${nTipX}" y2="${nTipY}" stroke="#2563eb" stroke-width="3" marker-end="url(#arr-m3-blue)" />
        ${svgBadge(nTipX - 10 * Math.sin(thetaRad), nTipY - 18, 'N', '', true, fmt(N, 0) + ' N', '#2563eb', '#93c5fd')}

        <!-- Vector Peso P (vertical hacia abajo) -->
        <line x1="${cmX}" y1="${cmY}" x2="${pTipX}" y2="${pTipY}" stroke="#dc2626" stroke-width="3" marker-end="url(#arr-m3-red)" />
        ${svgBadge(pTipX, pTipY + 18, 'P', '', true, fmt(P, 0) + ' N', '#dc2626', '#fca5a5')}

        <!-- Componente Py (perpendicular al plano, se anula con N) -->
        ${thetaDeg > 0 ? `
          <line x1="${cmX}" y1="${cmY}" x2="${pyTipX}" y2="${pyTipY}" stroke="#dc2626" stroke-width="2.5" stroke-dasharray="5,4" marker-end="url(#arr-m3-red)" />
          ${svgBadge(pyTipX + 36 * Math.sin(thetaRad) + 30, pyTipY + 36 * Math.cos(thetaRad) - 4, 'P', 'y', true, fmt(Py, 0) + ' N', '#dc2626', '#fca5a5')}
        ` : ''}

        <!-- Componente Px (a lo largo del plano, hacia abajo) -->
        ${Px > 1 ? `
          <line x1="${cmX}" y1="${cmY}" x2="${pparTipX}" y2="${pparTipY}" stroke="#dc2626" stroke-width="2.5" stroke-dasharray="5,4" marker-end="url(#arr-m3-red)" />
          ${svgBadge(pparTipX - 42 * Math.cos(thetaRad), pparTipY + 42 * Math.sin(thetaRad) - 10, 'P', 'x', true, fmt(Px, 0) + ' N', '#dc2626', '#fca5a5')}
        ` : ''}

        <!-- Fuerza de rozamiento fk (hacia arriba de la rampa) -->
        ${fk > 0.5 ? `
          <line x1="${cmX}" y1="${cmY}" x2="${fkTipX}" y2="${fkTipY}" stroke="#ea580c" stroke-width="3" marker-end="url(#arr-m3-orange)" />
          ${svgBadge(fkTipX + 44 * Math.cos(thetaRad), fkTipY - 44 * Math.sin(thetaRad) - 10, 'f', 'k', true, fmt(fk, 0) + ' N', '#ea580c', '#fed7aa')}
        ` : ''}
      `;

      svg.innerHTML = svgHtml;
    }

    if (btnAnim) {
      btnAnim.addEventListener('click', () => {
        if (animInterval) {
          clearInterval(animInterval);
          animInterval = null;
          animOffset = 0;
          btnAnim.textContent = '▶ Iniciar Descenso';
          update();
          return;
        }

        const thetaDeg = parseFloat(degInput.value);
        const thetaRad = (thetaDeg * Math.PI) / 180;
        const uk = parseFloat(ukInput.value);
        if (Math.sin(thetaRad) <= uk * Math.cos(thetaRad)) {
          alert('Con estos valores el cuerpo no acelera hacia abajo (Pₓ ≤ f_k). Aumentá el ángulo o reducí el coeficiente.');
          return;
        }

        btnAnim.textContent = '⏹ Detener / Reiniciar';
        animOffset = 0;
        animInterval = setInterval(() => {
          animOffset += 0.035;
          if (animOffset >= 1) {
            animOffset = 1;
            clearInterval(animInterval);
            animInterval = null;
            btnAnim.textContent = '↺ Reiniciar';
          }
          update();
        }, 30);
      });
    }

    degInput.addEventListener('input', () => { animOffset = 0; update(); });
    mInput.addEventListener('input', () => { animOffset = 0; update(); });
    ukInput.addEventListener('input', () => { animOffset = 0; update(); });
    update();
  }

  /* ==========================================================================
     SIMULADOR 4: CUERPOS VINCULADOS (CON DCL SEPARADOS E INDIVIDUALES)
     ========================================================================== */
  function initSim4() {
    const m1Input = document.getElementById('sim4-m1');
    const m2Input = document.getElementById('sim4-m2');
    const ukInput = document.getElementById('sim4-uk');
    const svgSystem = document.getElementById('sim4-svg');
    const svgDcl1 = document.getElementById('sim4-dcl1-svg');
    const svgDcl2 = document.getElementById('sim4-dcl2-svg');
    const btnSoltar = document.getElementById('sim4-btn-soltar');
    const btnCortar = document.getElementById('sim4-btn-cortar');

    if (!m1Input || !m2Input || !ukInput) return;

    let cuerdaCortada = false;
    let posProg = 0;
    let animLoop = null;

    function renderDCLs(m1, m2, uk, T, fk, N1, P1, P2, a) {
      // DCL 1: Bloque sobre la mesa aislado (viewBox 0 0 280 240)
      if (svgDcl1) {
        const cx = 140, cy = 120;
        const bw = 76, bh = 48;
        svgDcl1.innerHTML = `
          <defs>
            <marker id="dcl1-arr-blue" viewBox="0 0 10 10" refX="7" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse"><path d="M 0 1.5 L 8 5 L 0 8.5 z" fill="#2563eb" /></marker>
            <marker id="dcl1-arr-red" viewBox="0 0 10 10" refX="7" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse"><path d="M 0 1.5 L 8 5 L 0 8.5 z" fill="#dc2626" /></marker>
            <marker id="dcl1-arr-orange" viewBox="0 0 10 10" refX="7" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse"><path d="M 0 1.5 L 8 5 L 0 8.5 z" fill="#ea580c" /></marker>
            <marker id="dcl1-arr-green" viewBox="0 0 10 10" refX="7" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse"><path d="M 0 1.5 L 8 5 L 0 8.5 z" fill="#16a34a" /></marker>
          </defs>
          
          <!-- Bloque aislado -->
          <rect x="${cx - bw/2}" y="${cy - bh/2}" width="${bw}" height="${bh}" rx="4" fill="#f8fafc" stroke="#1e293b" stroke-width="2.5" />
          <text x="${cx + 8}" y="${cy + bh/2 + 16}" text-anchor="start" font-size="12" font-weight="bold" fill="#1e293b">m₁ = ${fmt(m1, 1)} kg</text>
          <circle cx="${cx}" cy="${cy}" r="3.5" fill="#0f172a" />

          <!-- Normal N1 hacia arriba -->
          <line x1="${cx}" y1="${cy}" x2="${cx}" y2="${cy - 78}" stroke="#2563eb" stroke-width="2.5" marker-end="url(#dcl1-arr-blue)" />
          ${svgBadge(cx, cy - 78 - 18, 'N', '1', true, fmt(N1, 1) + ' N', '#2563eb', '#93c5fd')}

          <!-- Peso P1 hacia abajo -->
          <line x1="${cx}" y1="${cy}" x2="${cx}" y2="${cy + 78}" stroke="#dc2626" stroke-width="2.5" marker-end="url(#dcl1-arr-red)" />
          ${svgBadge(cx, cy + 78 + 18, 'P', '1', true, fmt(P1, 1) + ' N', '#dc2626', '#fca5a5')}

          <!-- Tensión T hacia la derecha -->
          <line x1="${cx}" y1="${cy}" x2="${cx + 76}" y2="${cy}" stroke="#16a34a" stroke-width="2.5" marker-end="url(#dcl1-arr-green)" />
          ${svgBadge(cx + 76 + 36, cy - 14, 'T', '', true, fmt(T, 1) + ' N', '#15803d', '#86efac')}

          <!-- Rozamiento fk hacia la izquierda -->
          ${fk > 0.1 ? `
            <line x1="${cx}" y1="${cy}" x2="${cx - 76}" y2="${cy}" stroke="#ea580c" stroke-width="2.5" marker-end="url(#dcl1-arr-orange)" />
            ${svgBadge(cx - 76 - 36, cy - 14, 'f', 'k', true, fmt(fk, 1) + ' N', '#ea580c', '#fed7aa')}
          ` : ''}
        `;
      }

      // DCL 2: Masa colgante aislada (viewBox 0 0 280 240)
      if (svgDcl2) {
        const cx = 140, cy = 120;
        const bw = 68, bh = 54;
        svgDcl2.innerHTML = `
          <defs>
            <marker id="dcl2-arr-green" viewBox="0 0 10 10" refX="7" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse"><path d="M 0 1.5 L 8 5 L 0 8.5 z" fill="#16a34a" /></marker>
            <marker id="dcl2-arr-red" viewBox="0 0 10 10" refX="7" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse"><path d="M 0 1.5 L 8 5 L 0 8.5 z" fill="#dc2626" /></marker>
          </defs>

          <!-- Bloque colgante aislado -->
          <rect x="${cx - bw/2}" y="${cy - bh/2}" width="${bw}" height="${bh}" rx="4" fill="#eff6ff" stroke="#1d4ed8" stroke-width="2.5" />
          <text x="${cx + 8}" y="${cy + bh/2 + 16}" text-anchor="start" font-size="12" font-weight="bold" fill="#1d4ed8">m₂ = ${fmt(m2, 1)} kg</text>
          <circle cx="${cx}" cy="${cy}" r="3.5" fill="#0f172a" />

          <!-- Tensión T hacia arriba -->
          <line x1="${cx}" y1="${cy}" x2="${cx}" y2="${cy - 78}" stroke="#16a34a" stroke-width="2.5" marker-end="url(#dcl2-arr-green)" />
          ${svgBadge(cx, cy - 78 - 18, 'T', '', true, fmt(T, 1) + ' N', '#15803d', '#86efac')}

          <!-- Peso P2 hacia abajo -->
          <line x1="${cx}" y1="${cy}" x2="${cx}" y2="${cy + 78}" stroke="#dc2626" stroke-width="2.5" marker-end="url(#dcl2-arr-red)" />
          ${svgBadge(cx, cy + 78 + 18, 'P', '2', true, fmt(P2, 1) + ' N', '#dc2626', '#fca5a5')}
        `;
      }
    }

    function update() {
      const m1 = parseFloat(m1Input.value);
      const m2 = parseFloat(m2Input.value);
      const uk = parseFloat(ukInput.value);

      document.getElementById('sim4-m1-val').textContent = fmt(m1, 1) + ' kg';
      document.getElementById('sim4-m2-val').textContent = fmt(m2, 1) + ' kg';
      document.getElementById('sim4-uk-val').textContent = fmt(uk, 2);

      const schM1 = document.getElementById('sim4-schema-m1-lbl');
      const schM2 = document.getElementById('sim4-schema-m2-lbl');
      if (schM1) schM1.textContent = `m₁ = ${fmt(m1, 1)} kg`;
      if (schM2) schM2.textContent = `m₂ = ${fmt(m2, 1)} kg`;

      const P1 = m1 * G_DEFAULT;
      const N1 = P1;
      const fk = uk * N1;
      const P2 = m2 * G_DEFAULT;

      let a = 0;
      let T = 0;
      let estadoTxt = '';

      if (cuerdaCortada) {
        T = 0;
        const a1 = uk > 0 ? -uk * G_DEFAULT : 0;
        const a2 = G_DEFAULT;
        estadoTxt = `¡CUERDA CORTADA! T = 0 N. Masa 2 cae libre (a = 9,8 m/s²). Masa 1 ${uk === 0 ? 'continúa por inercia con MRU (a = 0)' : `frena con a = ${fmt(a1, 2)} m/s²`}.`;
        document.getElementById('sim4-out-a').textContent = `m1: ${fmt(Math.abs(a1), 2)} | m2: ${fmt(a2, 1)} m/s²`;
        document.getElementById('sim4-out-t').textContent = '0,0 N';
      } else {
        if (P2 <= fk) {
          a = 0;
          T = P2;
          estadoTxt = 'Sistema en reposo (m2·g ≤ f_k en la mesa).';
        } else {
          a = (P2 - fk) / (m1 + m2);
          T = m1 * a + fk;
          estadoTxt = `Sistema acelerado: a = ${fmt(a, 2)} m/s², Tensión T = ${fmt(T, 1)} N.`;
        }
        document.getElementById('sim4-out-a').textContent = fmt(a, 2) + ' m/s²';
        document.getElementById('sim4-out-t').textContent = fmt(T, 1) + ' N';
      }

      document.getElementById('sim4-out-fk').textContent = fmt(fk, 1) + ' N';
      document.getElementById('sim4-out-estado').textContent = estadoTxt;

      // Renderizar los DCLs separados
      renderDCLs(m1, m2, uk, T, fk, N1, P1, P2, a);

      // Renderizar sistema interactivo
      if (svgSystem) {
        const mesaX = 30, mesaY = 110, mesaW = 260, mesaH = 16;
        const poleaR = 15;
        // El hilo sale horizontal del bloque 1: la parte superior de la polea queda a la altura del punto de amarre
        const poleaX = mesaX + mesaW, poleaY = mesaY - 36 + 18 + poleaR;

        const b1X = 70 + posProg * 120;
        const b1Y = mesaY - 36;
        const b2X = poleaX + poleaR;
        const b2Y = poleaY + 45 + posProg * 90;

        svgSystem.innerHTML = `
          <!-- Mesa -->
          <rect x="${mesaX}" y="${mesaY}" width="${mesaW}" height="${mesaH}" fill="#94a3b8" stroke="#475569" stroke-width="2" />
          <line x1="${mesaX + 25}" y1="${mesaY + mesaH}" x2="${mesaX + 25}" y2="250" stroke="#64748b" stroke-width="4" />
          <line x1="${mesaX + mesaW - 35}" y1="${mesaY + mesaH}" x2="${mesaX + mesaW - 35}" y2="250" stroke="#64748b" stroke-width="4" />
          <line x1="15" y1="250" x2="420" y2="250" stroke="#334155" stroke-width="2.5" />

          <!-- Polea -->
          <circle cx="${poleaX}" cy="${poleaY}" r="${poleaR}" fill="#cbd5e1" stroke="#334155" stroke-width="2.5" />
          <circle cx="${poleaX}" cy="${poleaY}" r="3.5" fill="#0f172a" />

          <!-- Cuerda -->
          ${!cuerdaCortada ? `
            <line x1="${b1X + 52}" y1="${b1Y + 18}" x2="${poleaX}" y2="${poleaY - poleaR}" stroke="#ea580c" stroke-width="3" />
            <path d="M ${poleaX} ${poleaY - poleaR} A ${poleaR} ${poleaR} 0 0 1 ${poleaX + poleaR} ${poleaY}" fill="none" stroke="#ea580c" stroke-width="3" />
            <line x1="${poleaX + poleaR}" y1="${poleaY}" x2="${b2X}" y2="${b2Y}" stroke="#ea580c" stroke-width="3" />
          ` : `
            <line x1="${b1X + 52}" y1="${b1Y + 18}" x2="${b1X + 80}" y2="${b1Y + 18}" stroke="#ea580c" stroke-width="2.5" />
            <line x1="${b2X}" y1="${b2Y - 35}" x2="${b2X}" y2="${b2Y}" stroke="#ea580c" stroke-width="2.5" />
            <g transform="translate(${poleaX - 50}, ${poleaY - 22})">
              <rect x="0" y="0" width="110" height="20" rx="3" fill="#fee2e2" stroke="#ef4444" stroke-width="1" />
              <text x="55" y="14" text-anchor="middle" fill="#dc2626" font-size="11" font-weight="bold">✂ Cuerda Cortada</text>
            </g>
          `}

          <!-- Bloque 1 (Mesa) -->
          <rect x="${b1X}" y="${b1Y}" width="52" height="36" rx="3" fill="#f8fafc" stroke="#1e293b" stroke-width="2" />
          <text x="${b1X + 26}" y="${b1Y + 22}" text-anchor="middle" font-size="12" font-weight="bold" fill="#1e293b">m₁</text>

          <!-- Bloque 2 (Colgante) -->
          <rect x="${b2X - 18}" y="${b2Y}" width="36" height="40" rx="3" fill="#3b82f6" stroke="#1d4ed8" stroke-width="2" />
          <text x="${b2X}" y="${b2Y + 24}" text-anchor="middle" font-size="12" font-weight="bold" fill="#ffffff">m₂</text>
        `;
      }
    }

    if (btnSoltar) {
      btnSoltar.addEventListener('click', () => {
        if (animLoop) {
          clearInterval(animLoop);
          animLoop = null;
        }
        cuerdaCortada = false;
        posProg = 0;
        animLoop = setInterval(() => {
          posProg += 0.02;
          if (posProg >= 1) {
            posProg = 1;
            clearInterval(animLoop);
            animLoop = null;
          }
          update();
        }, 30);
        update();
      });
    }

    if (btnCortar) {
      btnCortar.addEventListener('click', () => {
        cuerdaCortada = true;
        update();
      });
    }

    m1Input.addEventListener('input', () => { posProg = 0; cuerdaCortada = false; update(); });
    m2Input.addEventListener('input', () => { posProg = 0; cuerdaCortada = false; update(); });
    ukInput.addEventListener('input', () => { posProg = 0; cuerdaCortada = false; update(); });
    update();
  }

  /* ==========================================================================
     SIMULADOR 5: ACOPLE DINÁMICA - CINEMÁTICA 
     ========================================================================== */
  function initSim5() {
    const v0Input = document.getElementById('sim5-v0');
    const ukInput = document.getElementById('sim5-uk');
    const svgTrack = document.getElementById('sim5-track-svg');
    const svgPlot = document.getElementById('sim5-plot-svg');
    const btnPlay = document.getElementById('sim5-btn-play');

    if (!v0Input || !ukInput || !svgTrack || !svgPlot) return;

    let animInterval = null;
    let tSim = 0;

    function update() {
      const v0 = parseFloat(v0Input.value);
      const uk = parseFloat(ukInput.value);

      document.getElementById('sim5-v0-val').textContent = fmt(v0, 1) + ' m/s';
      document.getElementById('sim5-uk-val').textContent = fmt(uk, 2);

      // Dinámica: a = -uk * g
      const a_frenado = -uk * G_DEFAULT;
      // Cinemática: t_total = v0 / |a|, d_total = v0^2 / (2 |a|)
      const t_total = v0 / Math.abs(a_frenado);
      const d_total = (v0 * v0) / (2 * Math.abs(a_frenado));

      document.getElementById('sim5-out-a').textContent = fmt(a_frenado, 2) + ' m/s²';
      document.getElementById('sim5-out-d').textContent = fmt(d_total, 2) + ' m';
      document.getElementById('sim5-out-t').textContent = fmt(t_total, 2) + ' s';

      // Posición y velocidad en el instante actual de la animación
      const tCur = Math.min(t_total, tSim);
      const vCur = Math.max(0, v0 + a_frenado * tCur);
      const xCur = v0 * tCur + 0.5 * a_frenado * tCur * tCur;

      // Dibujar Pista de Frenado SVG
      const trackW = 460, trackH = 140;
      const xStartRugosa = 140; // la pista rugosa comienza aquí
      const scaleX = (trackW - xStartRugosa - 40) / Math.max(12, d_total);
      const blockX = xStartRugosa + xCur * scaleX;

      svgTrack.innerHTML = `
        <defs>
          <marker id="arr-green" viewBox="0 0 10 10" refX="7" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse">
            <path d="M 0 1.5 L 8 5 L 0 8.5 z" fill="#16a34a" />
          </marker>
          <pattern id="rough-pattern" width="12" height="12" patternTransform="rotate(45 0 0)" patternUnits="userSpaceOnUse">
            <line x1="0" y1="0" x2="0" y2="12" stroke="#ea580c" stroke-width="2.5" />
          </pattern>
        </defs>

        <!-- Pista Lisa -->
        <rect x="20" y="80" width="${xStartRugosa - 20}" height="18" fill="#e2e8f0" stroke="#64748b" stroke-width="2" />
        <text x="70" y="115" font-size="11" font-weight="bold" fill="#64748b">Zona Lisa (μ = 0)</text>

        <!-- Pista Rugosa -->
        <rect x="${xStartRugosa}" y="80" width="${trackW - xStartRugosa}" height="18" fill="url(#rough-pattern)" stroke="#c2410c" stroke-width="2" />
        <text x="${xStartRugosa + 50}" y="115" font-size="11" font-weight="bold" fill="#c2410c">Zona Rugosa (μk = ${fmt(uk, 2)})</text>

        <!-- Marcador de inicio de frenado -->
        <line x1="${xStartRugosa}" y1="30" x2="${xStartRugosa}" y2="98" stroke="#dc2626" stroke-width="1.8" stroke-dasharray="4,4" />

        <!-- Bloque deslizante (se dibuja encima del marcador para que no cruce la "m") -->
        <g transform="translate(${Math.min(trackW - 50, blockX)}, 42)">
          <rect x="-25" y="0" width="50" height="38" rx="4" fill="#3b82f6" stroke="#1d4ed8" stroke-width="2" />
          <text x="0" y="23" text-anchor="middle" font-size="12" font-weight="bold" fill="#ffffff">m</text>
          
          <!-- Flecha de velocidad si está en movimiento -->
          ${vCur > 0.1 ? `
            <line x1="25" y1="19" x2="${25 + Math.min(80, vCur * 6)}" y2="19" stroke="#16a34a" stroke-width="2.5" marker-end="url(#arr-green)" />
            ${svgBadge(25 + Math.min(80, vCur * 6) + 70, 19, 'v', '', true, fmt(vCur, 1) + ' m/s', '#15803d', '#86efac')}
          ` : ''}
        </g>

        <text x="${xStartRugosa - 8}" y="22" text-anchor="end" font-size="10" font-weight="bold" fill="#dc2626">Entrada: v₀ = ${fmt(v0, 1)} m/s</text>
      `;

      // Dibujar Gráfica v(t) en tiempo real
      const pw = 300, ph = 150, pPadL = 45, pPadB = 30;
      const xPlot = (t) => pPadL + (t / Math.max(3, t_total)) * (pw - pPadL - 20);
      const yPlot = (v) => (ph - pPadB) - (v / Math.max(8, v0)) * (ph - pPadB - 20);

      svgPlot.innerHTML = `
        <line x1="${pPadL}" y1="${ph - pPadB}" x2="${pw - 16}" y2="${ph - pPadB}" stroke="#475569" stroke-width="2" />
        <polygon points="${pw - 6},${ph - pPadB} ${pw - 17},${ph - pPadB - 5} ${pw - 17},${ph - pPadB + 5}" fill="#475569" />
        <line x1="${pPadL}" y1="${ph - pPadB}" x2="${pPadL}" y2="18" stroke="#475569" stroke-width="2" />
        <polygon points="${pPadL},8 ${pPadL - 5},19 ${pPadL + 5},19" fill="#475569" />
        <text x="${pw - 6}" y="${ph - pPadB + 20}" text-anchor="end" font-size="11" font-weight="bold" fill="#334155">t (s)</text>
        <text x="${pPadL + 10}" y="16" font-size="11" font-weight="bold" fill="#334155">v (m/s)</text>

        <!-- Recta decreciente v(t) = v0 + at -->
        <line x1="${xPlot(0)}" y1="${yPlot(v0)}" x2="${xPlot(t_total)}" y2="${yPlot(0)}" stroke="#2563eb" stroke-width="3" />

        <!-- Punto actual de la simulación -->
        <circle cx="${xPlot(tCur)}" cy="${yPlot(vCur)}" r="5.5" fill="#dc2626" stroke="#ffffff" stroke-width="2" />
        <text x="${xPlot(tCur) + 8}" y="${yPlot(vCur) - 5}" font-size="10" font-weight="bold" fill="#dc2626">${fmt(vCur, 1)} m/s</text>
      `;
    }

    if (btnPlay) {
      btnPlay.addEventListener('click', () => {
        if (animInterval) {
          clearInterval(animInterval);
          animInterval = null;
          tSim = 0;
          btnPlay.textContent = '▶ Iniciar Frenado';
          update();
          return;
        }

        const v0 = parseFloat(v0Input.value);
        const uk = parseFloat(ukInput.value);
        const t_total = v0 / (uk * G_DEFAULT);

        tSim = 0;
        btnPlay.textContent = '⏹ Detener / Reiniciar';
        animInterval = setInterval(() => {
          tSim += 0.05;
          if (tSim >= t_total) {
            tSim = t_total;
            clearInterval(animInterval);
            animInterval = null;
            btnPlay.textContent = '↺ Repetir Frenado';
          }
          update();
        }, 40);
      });
    }

    v0Input.addEventListener('input', () => { tSim = 0; update(); });
    ukInput.addEventListener('input', () => { tSim = 0; update(); });
    update();
  }

  /* ==========================================================================
     MICRODESAFÍOS FORMATIVOS (MÓDULOS 1 A 5)
     ========================================================================== */
  function initMicroChallenges() {
    // Micro 1
    const btnM1 = document.getElementById('btn-micro-1');
    if (btnM1) {
      btnM1.addEventListener('click', () => {
        const inN = document.getElementById('micro1-n').value;
        const inA = document.getElementById('micro1-a').value;
        const fb = document.getElementById('fb-micro-1');
        const sol = document.getElementById('sol-micro-1');

        const okN = checkTolerance(inN, 40.3, 41.7, 0.05);
        const okA = checkTolerance(inA, 1.16, 1.06, 0.08);

        fb.style.display = 'block';
        if (okN && okA) {
          fb.className = 'psd-feedback correct';
          fb.innerHTML = '<strong>¡Excelente!</strong> Calculaste correctamente la Normal y la aceleración aplicando la 2.ª Ley.';
          addScore(10, 'micro_1');
        } else {
          fb.className = 'psd-feedback wrong';
          fb.innerHTML = '<strong>Revisá tus cálculos:</strong> Recordá que en el eje vertical: \\(N + F\\operatorname{sen}(45^\\circ) - P = 0 \\implies N = mg - F\\operatorname{sen}(45^\\circ)\\).';
        }
        if (sol) sol.style.display = 'block';
        renderMath(sol);
      });
    }

    // Micro 2
    const btnM2 = document.getElementById('btn-micro-2');
    if (btnM2) {
      btnM2.addEventListener('click', () => {
        const inFs1 = document.getElementById('micro2-fs1').value;
        const inFs2 = document.getElementById('micro2-fs2').value;
        const fb = document.getElementById('fb-micro-2');
        const sol = document.getElementById('sol-micro-2');

        const ok1 = checkTolerance(inFs1, 50, 50, 0.02);
        const ok2 = checkTolerance(inFs2, 100, 100, 0.02);

        fb.style.display = 'block';
        if (ok1 && ok2) {
          fb.className = 'psd-feedback correct';
          fb.innerHTML = '<strong>¡Impecable!</strong> Entendiste que el rozamiento estático es reactivo y equilibra exactamente la fuerza aplicada mientras haya reposo.';
          addScore(10, 'micro_2');
        } else {
          fb.className = 'psd-feedback wrong';
          fb.innerHTML = '<strong>¡Atención al concepto!</strong> Si el ropero no se mueve cuando aplicás 50 N, \\(f_s = 50\\text{ N}\\). Si aumentás a 100 N y sigue quieto, \\(f_s = 100\\text{ N}\\).';
        }
        if (sol) sol.style.display = 'block';
        renderMath(sol);
      });
    }

    // Micro 3
    const btnM3 = document.getElementById('btn-micro-3');
    if (btnM3) {
      btnM3.addEventListener('click', () => {
        const inUk = document.getElementById('micro3-uk').value;
        const fb = document.getElementById('fb-micro-3');
        const sol = document.getElementById('sol-micro-3');

        const okUk = checkTolerance(inUk, 0.75, 0.754, 0.04);

        fb.style.display = 'block';
        if (okUk) {
          fb.className = 'psd-feedback correct';
          fb.innerHTML = '<strong>¡Correcto!</strong> En equilibrio dinámico (MRU): \\(\\mu_k = \\tan\\theta = \\tan(37^\\circ) \\approx 0{,}75\\).';
          addScore(10, 'micro_3');
        } else {
          fb.className = 'psd-feedback wrong';
          fb.innerHTML = '<strong>Verificá:</strong> En MRU descendente, \\(mg\\operatorname{sen}(37^\\circ) = \\mu_k mg\\cos(37^\\circ) \\implies \\mu_k = \\tan(37^\\circ)\\).';
        }
        if (sol) sol.style.display = 'block';
        renderMath(sol);
      });
    }

    // Micro 4
    const btnM4 = document.getElementById('btn-micro-4');
    if (btnM4) {
      btnM4.addEventListener('click', () => {
        const inA = document.getElementById('micro4-a').value;
        const inT1 = document.getElementById('micro4-t1').value;
        const fb = document.getElementById('fb-micro-4');
        const sol = document.getElementById('sol-micro-4');

        const okA = checkTolerance(inA, 2.5, 2.5, 0.04);
        const okT1 = checkTolerance(inT1, 0.50, 0.50, 0.05);

        fb.style.display = 'block';
        if (okA && okT1) {
          fb.className = 'psd-feedback correct';
          fb.innerHTML = '<strong>¡Excelente!</strong> Aceleración del sistema \\(a = 2{,}5\\text{ m/s}^2\\) y tensión \\(T_1 = m_1 a = 0{,}50\\text{ N}\\).';
          addScore(10, 'micro_4');
        } else {
          fb.className = 'psd-feedback wrong';
          fb.innerHTML = '<strong>Revisá el planteo:</strong> Sumá la masa de los 3 vagones para hallar \\(a\\), y aislá el vagón 1 para \\(T_1\\).';
        }
        if (sol) sol.style.display = 'block';
        renderMath(sol);
      });
    }

    // Micro 5
    const btnM5 = document.getElementById('btn-micro-5');
    if (btnM5) {
      btnM5.addEventListener('click', () => {
        const inUk = document.getElementById('micro5-uk').value;
        const fb = document.getElementById('fb-micro-5');
        const sol = document.getElementById('sol-micro-5');

        // v0 = 4.0 m/s, Delta x = 5.0 m -> a = -1.6 m/s^2 -> uk = 1.6 / 9.8 = 0.163 (o 0.16 con g=10)
        const okUk = checkTolerance(inUk, 0.16, 0.163, 0.05);

        fb.style.display = 'block';
        if (okUk) {
          fb.className = 'psd-feedback correct';
          fb.innerHTML = '<strong>¡Muy bien!</strong> Tal como en el ejemplo resuelto: \\(a = -1{,}6\\text{ m/s}^2\\) y \\(\\mu = \\frac{|a|}{g} = 0{,}16\\).';
          addScore(10, 'micro_5');
        } else {
          fb.className = 'psd-feedback wrong';
          fb.innerHTML = '<strong>Verificá:</strong> De la cinemática, \\(0 = v_0^2 + 2a\\Delta x \\implies a = -1{,}6\\text{ m/s}^2\\). Por la 2.ª Ley, \\(f_k = \\mu mg = m|a| \\implies \\mu = |a|/g\\).';
        }
        if (sol) sol.style.display = 'block';
        renderMath(sol);
      });
    }
  }

  /* ==========================================================================
     TALLER DE PROBLEMAS DE BACHILLERATO (MÓDULO 6 - 8 PROBLEMAS)
     ========================================================================== */
  const WORKSHOP_PROBLEMS = {
    1: {
      title: 'El ropero y el umbral de reposo',
      statement: 'Un ropero de $40\\text{ kg}$ de masa, apoyado sobre el piso horizontal, se empuja con una fuerza horizontal de $50\\text{ N}$, sin embargo este no se mueve. Luego se aumenta la fuerza a $100\\text{ N}$ y aún permanece en reposo.',
      questions: [
        { label: 'Módulo de la fuerza de rozamiento estático con F = 50 N:', unit: 'N', t1: 50, t2: 50 },
        { label: 'Módulo de la fuerza de rozamiento estático con F = 100 N:', unit: 'N', t1: 100, t2: 100 },
        { label: 'Si μs = 0,40, fuerza horizontal máxima sin que se mueva (g = 9,8 m/s²):', unit: 'N', t1: 156.8, t2: 160.0 }
      ],
      solution: `
        <strong>Resolución paso a paso:</strong><br>
        1. En reposo: $\\Sigma \\vec{F} = \\vec{0} \\implies F - f_s = 0 \\implies f_s = F$.<br>
        2. Por tanto: para $F = 50\\text{ N}$, $f_s = 50\\text{ N}$. Para $F = 100\\text{ N}$, $f_s = 100\\text{ N}$.<br>
        3. Fuerza máxima: $f_{s,\\text{máx}} = \\mu_s N = 0{,}40 \\cdot (40\\text{ kg} \\cdot 9{,}8\\text{ m/s}^2) = 156{,}8\\text{ N}$ (o $160\\text{ N}$ con $g=10$).
      `
    },
    2: {
      title: 'Cajón sobre mesa con μs y μk',
      statement: 'Un cajón de $10\\text{ kg}$ está apoyado sobre una mesa horizontal. El coeficiente estático es $\\mu_s = 0{,}60$ y el cinético $\\mu_k = 0{,}40$. Se empuja con una fuerza horizontal de $80\\text{ N}$ ($g = 9{,}8\\text{ m/s}^2$).',
      questions: [
        { label: 'Fuerza máxima antes de moverse (fs,máx):', unit: 'N', t1: 58.8, t2: 60.0 },
        { label: 'Módulo de la fuerza de rozamiento cinético fk en movimiento:', unit: 'N', t1: 39.2, t2: 40.0 },
        { label: 'Módulo de la aceleración resultante:', unit: 'm/s²', t1: 4.08, t2: 4.00 }
      ],
      solution: `
        <strong>Resolución paso a paso:</strong><br>
        1. Normal: $N = mg = 98\\text{ N}$.<br>
        2. Umbral estático: $f_{s,\\text{máx}} = 0{,}60 \\cdot 98 = 58{,}8\\text{ N}$. Como $F = 80\\text{ N} > 58{,}8\\text{ N}$, rompe el reposo.<br>
        3. En movimiento: $f_k = \\mu_k N = 0{,}40 \\cdot 98 = 39{,}2\\text{ N}$.<br>
        4. Aceleración: $a = \\frac{F - f_k}{m} = \\frac{80 - 39{,}2}{10} = 4{,}08\\text{ m/s}^2$.
      `
    },
    3: {
      title: 'Descenso de un tobogán a velocidad constante',
      statement: 'Un niño de $30\\text{ kg}$ desciende por un tobogán inclinado $37^\\circ$ respecto a la horizontal con velocidad constante ($g = 9{,}8\\text{ m/s}^2$).',
      questions: [
        { label: 'Módulo de la fuerza de rozamiento cinético fk:', unit: 'N', t1: 176.9, t2: 180.5 },
        { label: 'Coeficiente de rozamiento cinético μk:', unit: '', t1: 0.75, t2: 0.754 }
      ],
      solution: `
        <strong>Resolución paso a paso:</strong><br>
        1. Velocidad constante $\\implies a = 0 \\implies P_x - f_k = 0$.<br>
        2. $f_k = mg\\operatorname{sen}(37^\\circ) = 30 \\cdot 9{,}8 \\cdot 0{,}6018 = 176{,}9\\text{ N}$.<br>
        3. Normal: $N = mg\\cos(37^\\circ) = 234{,}8\\text{ N}$. Coeficiente: $\\mu_k = \\tan(37^\\circ) \\approx 0{,}75$.
      `
    },
    4: {
      title: 'Fuerza aplicada oblicua con ángulo',
      statement: 'Se tira durante $5{,}0\\text{ s}$ de una caja de $7{,}0\\text{ kg}$ desde el reposo con $F = 40\\text{ N}$ a $45^\\circ$ sobre la horizontal. Con $\\mu_k = 0{,}50$ y $g = 9{,}8\\text{ m/s}^2$:',
      questions: [
        { label: 'Módulo de la fuerza Normal N:', unit: 'N', t1: 40.3, t2: 41.7 },
        { label: 'Módulo de la aceleración:', unit: 'm/s²', t1: 1.16, t2: 1.06 },
        { label: 'Velocidad final alcanzada a los 5,0 s:', unit: 'm/s', t1: 5.8, t2: 5.3 }
      ],
      solution: `
        <strong>Resolución paso a paso:</strong><br>
        1. $F_x = F_y = 40\\cos(45^\\circ) = 28{,}28\\text{ N}$.<br>
        2. $N = mg - F_y = 68{,}6 - 28{,}28 = 40{,}32\\text{ N}$.<br>
        3. $f_k = 0{,}50 \\cdot 40{,}32 = 20{,}16\\text{ N}$.<br>
        4. $a = \\frac{28{,}28 - 20{,}16}{7{,}0} = 1{,}16\\text{ m/s}^2$.<br>
        5. $v = v_0 + at = 1{,}16 \\cdot 5{,}0 = 5{,}8\\text{ m/s}$.
      `
    },
    5: {
      title: 'Tren de tres cuerpos vinculados',
      statement: 'Se tira de tres vagones $m_1 = 0{,}20\\text{ kg}$, $m_2 = 0{,}10\\text{ kg}$ y $m_3 = 0{,}30\\text{ kg}$ con cuerdas ideales sobre superficie lisa mediante $F = 1{,}5\\text{ N}$.',
      questions: [
        { label: 'Módulo de la aceleración del sistema:', unit: 'm/s²', t1: 2.50, t2: 2.50 },
        { label: 'Tensión T1 en la cuerda entre vagón 1 y 2:', unit: 'N', t1: 0.50, t2: 0.50 },
        { label: 'Tensión T2 en la cuerda entre vagón 2 y 3:', unit: 'N', t1: 0.75, t2: 0.75 }
      ],
      solution: `
        <strong>Resolución paso a paso:</strong><br>
        1. $m_T = 0{,}60\\text{ kg} \\implies a = \\frac{1{,}5}{0{,}60} = 2{,}50\\text{ m/s}^2$.<br>
        2. DCL Vagón 1: $T_1 = m_1 a = 0{,}20 \\cdot 2{,}50 = 0{,}50\\text{ N}$.<br>
        3. DCL Vagón 2: $T_2 - T_1 = m_2 a \\implies T_2 = 0{,}50 + 0{,}25 = 0{,}75\\text{ N}$.
      `
    },
    6: {
      title: 'Masa en mesa rugosa y masa colgante',
      statement: 'Un bloque $m_1 = 2{,}0\\text{ kg}$ en mesa con $\\mu_k = 0{,}20$ está vinculado por polea ideal a $m_2 = 3{,}0\\text{ kg}$ colgante ($g = 9{,}8\\text{ m/s}^2$).',
      questions: [
        { label: 'Módulo de la aceleración del sistema:', unit: 'm/s²', t1: 5.10, t2: 5.20 },
        { label: 'Tensión T de la cuerda:', unit: 'N', t1: 14.1, t2: 14.4 }
      ],
      solution: `
        <strong>Resolución paso a paso:</strong><br>
        1. Mesa: $N_1 = 19{,}6\\text{ N} \\implies f_k = 3{,}92\\text{ N}$. Ecuación: $T - 3{,}92 = 2{,}0 a$.<br>
        2. Colgante: $P_2 = 29{,}4\\text{ N}$. Ecuación: $29{,}4 - T = 3{,}0 a$.<br>
        3. Sumando: $25{,}48 = 5{,}0 a \\implies a = 5{,}10\\text{ m/s}^2$.<br>
        4. Tensión: $T = 3{,}92 + 2{,}0(5{,}10) = 14{,}12\\text{ N}$.
      `
    },
    7: {
      title: 'Dinámica de un elevador acelerado',
      statement: 'Un elevador de masa total $800\\text{ kg}$ asciende sostenido por un cable ($g = 9{,}8\\text{ m/s}^2$).',
      questions: [
        { label: 'Tensión en el cable a velocidad constante:', unit: 'N', t1: 7840, t2: 8000 },
        { label: 'Tensión al iniciar ascenso con a = 2,0 m/s²:', unit: 'N', t1: 9440, t2: 9600 }
      ],
      solution: `
        <strong>Resolución paso a paso:</strong><br>
        1. A velocidad constante: $T = mg = 800 \\cdot 9{,}8 = 7840\\text{ N}$ ($8000\\text{ N}$ con $g=10$).<br>
        2. Con aceleración hacia arriba: $T - P = ma \\implies T = m(g + a) = 800(11{,}8) = 9440\\text{ N}$ ($9600\\text{ N}$ con $g=10$).
      `
    },
    8: {
      title: 'Plano inclinado y cinemática acoplada',
      statement: 'Un bloque de $2{,}0\\text{ kg}$ desciende por un plano inclinado $30^\\circ$ de longitud $2{,}0\\text{ m}$ desde el reposo con $\\mu_k = 0{,}20$ ($g = 9{,}8\\text{ m/s}^2$).',
      questions: [
        { label: 'Módulo de la aceleración de descenso a:', unit: 'm/s²', t1: 3.20, t2: 3.27 },
        { label: 'Velocidad al final de la rampa (2,0 m):', unit: 'm/s', t1: 3.58, t2: 3.62 },
        { label: 'Tiempo que tarda en recorrer la rampa:', unit: 's', t1: 1.12, t2: 1.10 }
      ],
      solution: `
        <strong>Resolución paso a paso:</strong><br>
        1. $P_x = 9{,}8\\text{ N}$, $N = 16{,}97\\text{ N} \\implies f_k = 3{,}39\\text{ N}$.<br>
        2. Aceleración: $a = \\frac{9{,}8 - 3{,}39}{2{,}0} = 3{,}20\\text{ m/s}^2$.<br>
        3. Velocidad: $v = \\sqrt{2 a \\Delta x} = \\sqrt{2(3{,}20)(2{,}0)} = 3{,}58\\text{ m/s}$.<br>
        4. Tiempo: $t = \\sqrt{\\frac{2 \\Delta x}{a}} = \\sqrt{\\frac{4{,}0}{3{,}20}} = 1{,}12\\text{ s}$.
      `
    }
  };

  function initWorkshop() {
    const probContainer = document.getElementById('psd-prob-content');
    if (!probContainer) return;

    function renderProblem(id) {
      state.activeProb = id;
      const prob = WORKSHOP_PROBLEMS[id];
      if (!prob) return;

      document.querySelectorAll('.psd-prob-btn').forEach(btn => {
        btn.classList.toggle('active', parseInt(btn.dataset.pid) === id);
      });

      let qHtml = '';
      prob.questions.forEach((q, idx) => {
        qHtml += `
          <div class="psd-subq-item">
            <div class="psd-subq-title">${idx + 1}. ${q.label}</div>
            <div class="psd-input-group">
              <input type="number" step="any" id="ws-input-${id}-${idx}" placeholder="Valor numérico" />
              <span class="psd-unit">${q.unit}</span>
            </div>
          </div>
        `;
      });

      probContainer.innerHTML = `
        <h3 style="margin-top: 0.25rem;">Problema ${id}: ${prob.title}</h3>
        <div class="psd-prob-body">${prob.statement}</div>
        <div class="psd-subquestions">${qHtml}</div>
        <div style="margin-top: 1.25rem; display: flex; gap: 0.75rem; flex-wrap: wrap;">
          <button id="ws-btn-check-${id}" class="psd-btn psd-btn-primary">Verificar Respuesta</button>
          <button id="ws-btn-sol-${id}" class="psd-btn psd-btn-outline">Ver Planteo y Solución</button>
        </div>
        <div id="ws-fb-${id}" class="psd-feedback"></div>
        <div id="ws-sol-${id}" class="psd-solution-box" style="display: none;">${prob.solution}</div>
      `;

      renderMath(probContainer);

      document.getElementById(`ws-btn-check-${id}`).addEventListener('click', () => {
        let allOk = true;
        prob.questions.forEach((q, idx) => {
          const inp = document.getElementById(`ws-input-${id}-${idx}`);
          const ok = checkTolerance(inp ? inp.value : '', q.t1, q.t2, 0.05);
          if (inp) {
            inp.style.borderColor = ok ? '#22c55e' : '#ef4444';
          }
          if (!ok) allOk = false;
        });

        const fb = document.getElementById(`ws-fb-${id}`);
        fb.style.display = 'block';
        if (allOk) {
          fb.className = 'psd-feedback correct';
          fb.innerHTML = '<strong>¡Correcto!</strong> Todos los cálculos están dentro del margen físico aceptado.';
          addScore(10, 'prob_' + id);
        } else {
          fb.className = 'psd-feedback wrong';
          fb.innerHTML = '<strong>Hay valores fuera de tolerancia.</strong> Podés revisar el planteo analítico en el botón adjunto.';
        }
      });

      document.getElementById(`ws-btn-sol-${id}`).addEventListener('click', () => {
        const solBox = document.getElementById(`ws-sol-${id}`);
        if (solBox) {
          solBox.style.display = solBox.style.display === 'none' ? 'block' : 'none';
          renderMath(solBox);
        }
      });
    }

    document.querySelectorAll('.psd-prob-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        renderProblem(parseInt(btn.dataset.pid));
      });
    });

    renderProblem(state.activeProb || 1);
  }

  /* ==========================================================================
     BANCO AMPLIADO DE PROBLEMAS Y PREGUNTAS RESUELTAS (MÓDULO 7 - QUIZ INTERACTIVO)
     ========================================================================== */
  const BANK_QUIZ_DATA = {
    1: {
      correct: 'C',
      successMsg: '¡Excelente! Razonaste formalmente la 2.ª Ley: al duplicar la fuerza neta y reducir la masa a la mitad, la aceleración se cuadruplica (\\(a\' = 4a\\)).',
      errorMsg: 'Revisá la justificación física detallada a continuación para superar las concepciones erróneas comunes.'
    },
    2: {
      correct: 'B',
      successMsg: '¡Muy bien! Las fuerzas del par de interacción actúan sobre cuerpos distintos (mano y maletín), tienen igual módulo, misma dirección y sentidos opuestos.',
      errorMsg: 'Recordá que un par de acción y reacción nunca actúa sobre el mismo cuerpo ni corresponde a una condición de equilibrio.'
    },
    3: {
      correct: 'C',
      successMsg: '¡Exacto! Al tirar hacia arriba con un ángulo \\(\\alpha\\), la componente vertical ascendente alivia el apoyo (\\(N = mg - F\\operatorname{sen}\\alpha\\)), reduciendo el rozamiento cinético.',
      errorMsg: 'Analizá el equilibrio en el eje vertical para observar cómo varía la fuerza Normal en cada una de las tres configuraciones.'
    },
    4: {
      correct: 'B',
      successMsg: '¡Impecable! Mediante Torricelli obtenés \\(a = -2{,}025\\text{ m/s}^2\\) y por la 2.ª Ley \\(\\mu_k = |a|/g = 2{,}025/9{,}8 \\approx 0{,}207\\) (la masa se simplifica).',
      errorMsg: 'Deducí primero la aceleración de frenado con la ecuación de Torricelli y luego aplicá la 2.ª Ley en el eje horizontal.'
    },
    5: {
      correct: 'B',
      successMsg: '¡Excelente! Al ser fuerzas ortogonales a 90°, la resultante es \\(\\sqrt{F^2+F^2} = \\sqrt{2}F\\), por lo que la aceleración resultante es \\(\\sqrt{2}a_0 \\approx 1{,}414 a_0\\).',
      errorMsg: 'La suma de fuerzas es estrictamente vectorial: dos fuerzas perpendiculares se componen por Pitágoras, no algebraicamente.'
    },
    6: {
      correct: 'A',
      successMsg: '¡Perfecto! La tensión es \\(T = m_2(g+a) = 618\\text{ N}\\), y sobre la deportista \\(N = m_1 g - T = 637 - 618 = 19\\text{ N}\\), por lo que permanece firmemente apoyada en el suelo.',
      errorMsg: 'Planteá el DCL de la pesa acelerando hacia arriba y luego el DCL de la deportista en equilibrio sobre el piso.'
    }
  };

  function initSolvedBank() {
    // Selección al hacer clic en cualquier parte de la opción
    document.querySelectorAll('.psd-quiz-option').forEach(label => {
      label.addEventListener('click', () => {
        const input = label.querySelector('input[type="radio"]');
        if (!input || input.disabled) return;
        const qOptions = label.closest('.psd-quiz-options');
        if (!qOptions) return;
        const qid = qOptions.dataset.qid;
        document.querySelectorAll(`.psd-quiz-options[data-qid="${qid}"] .psd-quiz-option`).forEach(opt => {
          opt.classList.remove('selected');
        });
        label.classList.add('selected');
        input.checked = true;
      });
    });

    // Botones Comprobar Respuesta
    document.querySelectorAll('.psd-btn-check-quiz').forEach(btn => {
      btn.addEventListener('click', () => {
        const qid = btn.dataset.qid;
        const qData = BANK_QUIZ_DATA[qid];
        if (!qData) return;

        const selectedRadio = document.querySelector(`input[name="bank-opt-${qid}"]:checked`);
        const fb = document.getElementById(`bank-fb-${qid}`);
        const sol = document.getElementById(`bank-sol-${qid}`);
        const statusEl = document.getElementById(`bank-status-${qid}`);
        const retryBtn = document.querySelector(`.psd-btn-retry-quiz[data-qid="${qid}"]`);

        if (!selectedRadio) {
          if (fb) {
            fb.style.display = 'block';
            fb.className = 'psd-feedback wrong';
            fb.textContent = 'Por favor, seleccioná una de las opciones antes de comprobar.';
          }
          return;
        }

        const selectedVal = selectedRadio.value;
        const isCorrect = selectedVal === qData.correct;

        // Deshabilitar opciones y resaltar aciertos/errores
        document.querySelectorAll(`input[name="bank-opt-${qid}"]`).forEach(r => {
          r.disabled = true;
          const optLabel = r.closest('.psd-quiz-option');
          if (r.value === qData.correct) {
            optLabel.classList.add('opt-correct');
          } else if (r.checked) {
            optLabel.classList.add('opt-wrong');
          }
        });

        // Configurar mensaje de retroalimentación
        if (fb) {
          fb.style.display = 'block';
          if (isCorrect) {
            fb.className = 'psd-feedback correct';
            fb.innerHTML = `<strong>¡Opción ${selectedVal} Correcta!</strong> ${qData.successMsg}`;
            if (statusEl) {
              statusEl.className = 'psd-quiz-status is-correct';
              statusEl.textContent = '✓ Correcta';
            }
            addScore(10, 'bank_q_' + qid);
          } else {
            fb.className = 'psd-feedback wrong';
            fb.innerHTML = `<strong>Opción ${selectedVal} Incorrecta.</strong> La opción correcta es la <strong>Opción ${qData.correct}</strong>.<br>${qData.errorMsg}`;
            if (statusEl) {
              statusEl.className = 'psd-quiz-status is-wrong';
              statusEl.textContent = '✗ Incorrecta';
            }
          }
        }

        // Mostrar la solución detallada como retroalimentación
        if (sol) {
          sol.style.display = 'block';
          renderMath(sol);
        }

        btn.style.display = 'none';
        if (retryBtn) retryBtn.style.display = 'inline-flex';
      });
    });

    // Botones Reintentar
    document.querySelectorAll('.psd-btn-retry-quiz').forEach(btn => {
      btn.addEventListener('click', () => {
        const qid = btn.dataset.qid;
        const checkBtn = document.querySelector(`.psd-btn-check-quiz[data-qid="${qid}"]`);
        const fb = document.getElementById(`bank-fb-${qid}`);
        const sol = document.getElementById(`bank-sol-${qid}`);
        const statusEl = document.getElementById(`bank-status-${qid}`);

        document.querySelectorAll(`input[name="bank-opt-${qid}"]`).forEach(r => {
          r.disabled = false;
          r.checked = false;
          const optLabel = r.closest('.psd-quiz-option');
          optLabel.classList.remove('selected', 'opt-correct', 'opt-wrong');
        });

        if (fb) {
          fb.style.display = 'none';
          fb.innerHTML = '';
        }
        if (sol) {
          sol.style.display = 'none';
        }
        if (statusEl) {
          statusEl.className = 'psd-quiz-status';
          statusEl.textContent = '○ Sin responder';
        }

        btn.style.display = 'none';
        if (checkBtn) checkBtn.style.display = 'inline-flex';
      });
    });
  }

  /* ==========================================================================
     EVALUACIÓN ESCRITA EN PAPEL (PESTAÑA 8 - IMPRIMIBLE)
     ========================================================================== */
  function initPrintExam() {
    const btnPrint = document.getElementById('psd-btn-print-exam');
    if (btnPrint) {
      btnPrint.addEventListener('click', () => {
        window.print();
      });
    }
  }

  /* ==========================================================================
     NAVEGACIÓN POR PESTAÑAS (MÓDULOS)
     ========================================================================== */
  function initTabs() {
    const navBtns = document.querySelectorAll('.psd-nav-btn');
    const tabContents = document.querySelectorAll('.psd-tab-content');

    function switchTab(targetId) {
      state.activeTab = targetId;
      navBtns.forEach(b => b.classList.toggle('active', b.dataset.tab === targetId));
      tabContents.forEach(c => c.classList.toggle('active', c.id === 'tab-' + targetId));

      const activeContent = document.getElementById('tab-' + targetId);
      if (activeContent) {
        renderMath(activeContent);
      }
      window.scrollTo({ top: document.getElementById('psd-app-root').offsetTop - 20, behavior: 'smooth' });
    }

    navBtns.forEach(btn => {
      btn.addEventListener('click', () => switchTab(btn.dataset.tab));
    });

    document.querySelectorAll('.psd-btn-next-tab').forEach(btn => {
      btn.addEventListener('click', () => switchTab(btn.dataset.next));
    });

    const btnReset = document.getElementById('psd-btn-reset');
    if (btnReset) {
      btnReset.addEventListener('click', () => {
        if (confirm('¿Deseas reiniciar tu puntaje y ejercicios guardados en este navegador?')) {
          localStorage.removeItem(STORAGE_KEY);
          state.score = 0;
          state.solved = {};
          updateScoreUI();
          location.reload();
        }
      });
    }
  }

  /* ==========================================================================
     INICIALIZACIÓN GENERAL
     ========================================================================== */
  document.addEventListener('DOMContentLoaded', () => {
    loadState();
    initTabs();
    initSim1();
    initSim2();
    initSim3();
    initSim4();
    initSim5();
    initMicroChallenges();
    initWorkshop();
    initSolvedBank();
    initPrintExam();

    renderMath();
  });

})();
