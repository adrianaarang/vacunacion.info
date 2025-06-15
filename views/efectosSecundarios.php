<?php
require_once __DIR__ . '/header.php';
?>

<section class="container-xl my-5 efectos-secundarios"> <!-- ✅ Ancho amplio -->
  <h2 class="section-header text-center mb-4">Vacunas Infantiles y Posibles Efectos Secundarios</h2>

  <div class="alert alert-info text-center" role="alert">
    Aunque las vacunas pueden provocar efectos secundarios leves, su seguridad está ampliamente comprobada. Los beneficios superan con creces los riesgos.
  </div>

  <div class="text-center mt-3">
    <img src="/views/bootstrap/img/logo/logo5.png" alt="Logo" class="img-fluid" style="max-width: 120px;">
  </div>

  <!-- 🔘 Botones de filtro -->
  <div class="text-center filter-btns mb-4">
    <button class="btn btn-primary" onclick="filterCards('all')">Todas</button>
    <button class="btn btn-primary" onclick="filterCards('0-6m')">0-6 meses</button>
    <button class="btn btn-primary" onclick="filterCards('6-12m')">6-12 meses</button>
    <button class="btn btn-primary" onclick="filterCards('12-24m')">12-24 meses</button>
    <button class="btn btn-primary" onclick="filterCards('2-4a')">2-4 años</button>
    <button class="btn btn-primary" onclick="filterCards('adolescentes')">Adolescentes</button>
  </div>

  <!-- 💉 Tarjetas de vacunas -->
  <div class="row gx-4 gy-4 justify-content-center" id="card-container">
    <?php
    $vacunas = [
      ["id" => "hexavalente", "titulo" => "Hexavalente (DTPa-Hib-HepB-VPI)", "edad" => "2, 4, 11 meses", "grupo" => "0-6m", "inicio" => "24h", "efectos" => "Fiebre, dolor local, irritabilidad", "accion" => "Paracetamol y frío local."],
      ["id" => "neumococo", "titulo" => "Neumococo conjugada (VNC)", "edad" => "2, 4, 11 meses", "grupo" => "0-6m", "inicio" => "24h", "efectos" => "Fiebre, enrojecimiento", "accion" => "Antitérmicos si hay fiebre."],
      ["id" => "rotavirus", "titulo" => "Rotavirus (RV)", "edad" => "2, 4 meses", "grupo" => "0-6m", "inicio" => "1-2 días", "efectos" => "Diarrea, vómitos leves", "accion" => "Hidratación y observación."],
      ["id" => "meningococo-b", "titulo" => "Meningococo B", "edad" => "2, 4, 15 meses", "grupo" => "6-12m 12-24m", "inicio" => "24h", "efectos" => "Fiebre alta, llanto intenso", "accion" => "Paracetamol preventivo y observación."],
      ["id" => "meningococo-acwy", "titulo" => "Meningococo ACWY", "edad" => "12 meses, 12-18 años", "grupo" => "12-24m adolescentes", "inicio" => "24h", "efectos" => "Dolor leve en brazo", "accion" => "Reposo y analgésicos si es necesario."],
      ["id" => "triple-virica", "titulo" => "Triple Vírica (SRP)", "edad" => "12 meses y 3-4 años", "grupo" => "12-24m 2-4a", "inicio" => "día 5-12", "efectos" => "Fiebre, erupción", "accion" => "Control de fiebre y reposo."],
      ["id" => "varicela", "titulo" => "Varicela", "edad" => "15 meses y 3-4 años", "grupo" => "12-24m 2-4a", "inicio" => "día 5-15", "efectos" => "Fiebre, erupción leve", "accion" => "Antitérmicos y vigilancia."],
      ["id" => "vph", "titulo" => "Virus del Papiloma Humano (VPH)", "edad" => "12 años", "grupo" => "adolescentes", "inicio" => "24h", "efectos" => "Dolor, fatiga", "accion" => "Reposo y analgésicos si es necesario."],
      ["id" => "gripe-covid", "titulo" => "Gripe y COVID-19", "edad" => "Grupos de riesgo y adolescentes", "grupo" => "adolescentes", "inicio" => "24-48h", "efectos" => "Dolor en brazo, fiebre", "accion" => "Observación y antitérmicos si es necesario."],
      ["id" => "vrs", "titulo" => "VRS (Nirsevimab)", "edad" => "Neonatos y lactantes", "grupo" => "0-6m", "inicio" => "24h", "efectos" => "Enrojecimiento leve", "accion" => "Generalmente no requiere tratamiento."]
    ];

    foreach ($vacunas as $v):
    ?>
      <div class="col-12 col-md-6 col-lg-4 d-flex">
        <div class="card h-100 w-100 show" data-age="<?= htmlspecialchars($v["grupo"]) ?>" id="vacuna-<?= htmlspecialchars($v["id"]) ?>">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($v["titulo"]) ?></h5>
            <ul>
              <li><strong>Edad:</strong> <?= htmlspecialchars($v["edad"]) ?></li>
              <li><strong>Inicio:</strong> <?= htmlspecialchars($v["inicio"]) ?></li>
              <li><strong>Efectos:</strong> <?= htmlspecialchars($v["efectos"]) ?></li>
            </ul>
            <p><strong>Qué hacer:</strong> <?= htmlspecialchars($v["accion"]) ?></p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- JS para filtro por grupo -->
<script>
  function filterCards(grupo) {
    const cards = document.querySelectorAll('#card-container .card');
    cards.forEach(card => {
      const edades = card.getAttribute('data-age').split(' ');
      if (grupo === 'all' || edades.includes(grupo)) {
        card.classList.add('show');
      } else {
        card.classList.remove('show');
      }
    });
  }

  document.addEventListener('DOMContentLoaded', () => filterCards('all'));
</script>

<!-- JS para scroll automático si hay ?vacuna= -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const params = new URLSearchParams(window.location.search);
    const vacuna = params.get('vacuna');
    if (vacuna) {
      const tarjetas = document.querySelectorAll('#card-container .card');
      tarjetas.forEach(card => {
        const titulo = card.querySelector('.card-title')?.textContent.toLowerCase();
        if (titulo && titulo.includes(vacuna.toLowerCase())) {
          card.scrollIntoView({ behavior: 'smooth', block: 'center' });
          card.classList.add('border', 'border-3', 'border-primary');
          setTimeout(() => card.classList.remove('border', 'border-3', 'border-primary'), 3000);
        }
      });
    }
  });
</script>

<?php
require_once __DIR__ . '/footer.php';
?>
