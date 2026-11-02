window.AT = {
  label: 'Katalog Buku',
  ms: 1600,
  intro: '<div class="bk-book"><span></span><span></span><span></span></div>',
  bg: function (body) {
    var C = ['#7a1f1f', '#23402f', '#2a3a55', '#b4935a', '#4d1212', '#3a2a1a', '#54633c', '#6e3b1f'];
    var s = document.createElement('div'), h = '';
    s.className = 'bk-shelf';
    s.setAttribute('aria-hidden', 'true');
    for (var i = 0; i < 90; i++) {
      h += '<i style="--w:' + (14 + (i * 7) % 20) + 'px;--h:' + (62 + (i * 13) % 38) + '%;--c:' + C[(i * 3 + (i >> 2)) % 8] + ';--d:' + ((i % 30) * 22) + 'ms"></i>';
    }
    s.innerHTML = h;
    body.insertBefore(s, body.firstChild);
  }
};

/* Alat tabel: cari langsung dan ekspor CSV, tanpa mengubah data di server */
document.addEventListener('DOMContentLoaded', function () {
  var t = document.querySelector('table');
  if (!t || !t.querySelector('tr td')) return;
  var rows = Array.prototype.slice.call(t.querySelectorAll('tr')).filter(function (r) { return r.querySelector('td'); });
  var bar = document.createElement('div');
  bar.className = 'dt-bar';
  bar.innerHTML = '<input type="search" placeholder="Cari di tabel" aria-label="Cari di tabel"><span class="dt-count"></span><button type="button">Ekspor CSV</button>';
  var box = t.closest('.table-card, .table-responsive') || t;
  box.parentNode.insertBefore(bar, box);
  var count = bar.querySelector('.dt-count');
  var show = function (n) { count.textContent = n + ' baris'; };
  show(rows.length);
  bar.querySelector('input').addEventListener('input', function () {
    var q = this.value.toLowerCase(), n = 0;
    rows.forEach(function (r) {
      var hit = r.textContent.toLowerCase().indexOf(q) > -1;
      r.style.display = hit ? '' : 'none';
      if (hit) n++;
    });
    show(n);
  });
  bar.querySelector('button').addEventListener('click', function () {
    var cell = function (c) { return '"' + c.textContent.trim().replace(/\s+/g, ' ').replace(/"/g, '""') + '"'; };
    var lines = Array.prototype.map.call(t.querySelectorAll('tr'), function (r) {
      if (r.style.display === 'none') return null;
      var cs = Array.prototype.slice.call(r.children);
      return cs.slice(0, cs.length - 1).map(cell).join(',');
    }).filter(Boolean);
    var a = document.createElement('a');
    a.href = URL.createObjectURL(new Blob(['\ufeff' + lines.join('\n')], { type: 'text/csv;charset=utf-8' }));
    a.download = 'data.csv';
    a.setAttribute('data-no-at', '');
    document.body.appendChild(a);
    a.click();
    a.remove();
  });
});
