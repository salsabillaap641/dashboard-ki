@extends('layouts.app')
@section('title', 'Dashboard KI Kalteng')
@push('styles')
<style>
.ki-dash{display:grid;gap:16px;color:#17365e}.ki-panel{background:#fff;border:1px solid #e8eef6;border-radius:12px;box-shadow:0 3px 12px rgba(18,48,80,.045);padding:17px;min-width:0}
.ki-filter{padding:16px 18px}.ki-filter-form{display:grid;grid-template-columns:1fr 1fr auto auto;gap:12px;align-items:end}.ki-field label{display:block;font-size:12px;font-weight:700;color:#435773;margin-bottom:7px}.ki-field select{width:100%;min-height:40px;border:1px solid #dce5ef;border-radius:8px;padding:9px 11px;background:white;color:#203b5e}.ki-btn{display:inline-flex;align-items:center;justify-content:center;min-height:40px;padding:0 15px;border-radius:8px;border:0;background:#1e5a9d;color:#fff;text-decoration:none;font-size:12px;font-weight:750;cursor:pointer}.ki-btn.light{background:#fff;color:#39536f;border:1px solid #dce5ef}
.ki-hero{position:relative;overflow:hidden;border-radius:13px;min-height:265px;color:white;background:linear-gradient(100deg,#092a50 0%,#123f70 48%,#246d98 100%)}.ki-hero:after{content:"KI";position:absolute;right:8%;top:13%;width:180px;height:180px;border:1px solid #ffffff40;border-radius:50%;display:grid;place-items:center;font-size:62px;font-weight:900;color:#ffffffc7;box-shadow:0 0 0 28px #ffffff0b,0 0 0 55px #ffffff08}.ki-hero-copy{position:relative;z-index:1;max-width:690px;padding:31px 44px}.ki-kicker{font-size:11px;font-weight:800;letter-spacing:1.7px;text-transform:uppercase;color:#b5dfff;margin-bottom:14px}.ki-hero h1{margin:0 0 10px;color:white;font-size:clamp(28px,3vw,42px);line-height:1.13;letter-spacing:-.7px}.ki-hero p{margin:0;color:#e0edfb;font-size:14px;line-height:1.6}.ki-hero-link{display:inline-flex;margin-top:19px;background:white;color:#143b65;text-decoration:none;font-size:12px;font-weight:800;padding:11px 16px;border-radius:8px;gap:10px;align-items:center}.ki-hero-controls{position:absolute;right:17px;bottom:15px;display:flex;gap:5px}.ki-hero-controls button{width:8px;height:8px;padding:0;border:0;border-radius:10px;background:#ffffff70}.ki-hero-controls button.active{width:22px;background:white}
.ki-kpis{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:14px}.ki-kpi{display:flex;gap:12px;align-items:center;padding:16px}.ki-kpi-icon{width:42px;height:42px;border-radius:50%;flex:0 0 42px;display:grid;place-items:center;font-size:20px;font-weight:900}.ki-kpi-icon.blue{background:#e7f0ff;color:#3479d7}.ki-kpi-icon.green{background:#e3f7eb;color:#28a35e}.ki-kpi-icon.amber{background:#fff1d2;color:#ec9b17}.ki-kpi-icon.pink{background:#ffe4ed;color:#ed4b79}.ki-kpi-label{font-size:12px;color:#526985}.ki-kpi-value{font-size:26px;font-weight:850;line-height:1.25;color:#10345e}.ki-kpi-note{font-size:10px;color:#8191a6;margin-top:4px}
.ki-main-grid{display:grid;grid-template-columns:minmax(0,1.55fr) minmax(260px,.95fr) minmax(245px,.85fr);gap:14px;align-items:stretch}.ki-panel-title{font-size:14px;font-weight:850;margin:0;color:#123862}.ki-panel-head{display:flex;justify-content:space-between;gap:10px;align-items:center;margin-bottom:15px}.ki-chart{height:245px;position:relative}.ki-status-content{display:grid;grid-template-columns:1fr;gap:8px}.ki-donut{height:180px;position:relative}.ki-legend{display:grid;gap:9px}.ki-legend-row{display:flex;align-items:center;gap:7px;font-size:11px;color:#60748c}.ki-dot{width:8px;height:8px;border-radius:50%;flex:0 0 8px}.ki-legend-row strong{margin-left:auto;color:#183a60}
.ki-news{display:grid;gap:12px}.ki-news-row{display:flex;gap:10px;align-items:center}.ki-news-thumb{width:67px;height:57px;flex:0 0 67px;border-radius:8px;background:linear-gradient(135deg,#d9e8f5,#9cb8d2);display:grid;place-items:center;color:#2e5d8d;font-size:21px}.ki-news-title{font-size:11px;line-height:1.45;font-weight:800;color:#244465}.ki-news-sub{font-size:10px;color:#8493a5;margin-top:4px}
.ki-bottom{display:grid;grid-template-columns:minmax(0,2fr) minmax(250px,.85fr);gap:14px}.ki-products{display:grid;grid-template-columns:repeat(5,minmax(0,1fr));gap:10px}.ki-product-img{height:105px;border-radius:8px;background:#eef3f8;overflow:hidden;display:grid;place-items:center;color:#7890aa;font-size:25px}.ki-product-img img{width:100%;height:100%;object-fit:cover}.ki-product-title{font-size:11px;font-weight:800;line-height:1.4;margin:7px 0;color:#1f3e60;overflow-wrap:anywhere}.ki-product-type{display:inline-block;border-radius:99px;background:#eaf2ff;color:#285b95;padding:4px 7px;font-size:10px}.ki-empty{font-size:12px;color:#7b8ca1;line-height:1.6}.ki-sentra-banner{display:flex;align-items:center;justify-content:space-between;gap:16px;padding:23px 25px;min-height:130px;text-decoration:none;color:white;background:linear-gradient(105deg,#12355f,#1d6490);border-radius:12px;overflow:hidden;position:relative}.ki-sentra-banner:after{content:"";position:absolute;right:8%;width:120px;height:120px;border-radius:50%;border:1px solid #ffffff42;box-shadow:0 0 0 20px #ffffff0c,0 0 0 40px #ffffff08}.ki-sentra-copy{position:relative;z-index:1;max-width:700px}.ki-sentra-kicker{font-size:10px;letter-spacing:1.5px;font-weight:800;color:#b6ddff}.ki-sentra-title{font-size:22px;font-weight:850;margin:8px 0}.ki-sentra-desc{font-size:12px;color:#e1effa;line-height:1.5}.ki-sentra-cta{position:relative;z-index:1;white-space:nowrap;border-radius:8px;background:white;color:#153e68;padding:10px 13px;font-size:11px;font-weight:800}

.ki-panel-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 18px;
}

.ki-panel-heading h3 {
    margin: 0;
    color: #17365e;
    font-size: 18px;
    font-weight: 700;
}

.ki-panel-heading a {
    color: #2868ad;
    text-decoration: none;
    font-size: 12px;
    white-space: nowrap;
}

.ki-potential-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.ki-potential-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding-bottom: 14px;
    border-bottom: 1px solid #edf1f6;
}

.ki-potential-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.ki-potential-icon {
    width: 48px;
    height: 48px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    background: #e5efff;
    color: #3479d7;
    font-size: 20px;
}

.ki-potential-info {
    flex: 1;
    min-width: 0;
}

.ki-potential-name {
    color: #17365e;
    font-weight: 600;
    font-size: 14px;
    overflow-wrap: anywhere;
}

.ki-potential-type {
    color: #8191a6;
    font-size: 12px;
    margin-top: 4px;
}

.ki-potential-status {
    flex-shrink: 0;
    color: #218653;
    background: #e3f6eb;
    padding: 5px 8px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 600;
}

@media(max-width:1150px){.ki-main-grid{grid-template-columns:1fr 1fr}.ki-news-panel{grid-column:1/-1}.ki-news{grid-template-columns:repeat(3,minmax(0,1fr))}.ki-bottom{grid-template-columns:1fr}}
@media(max-width:780px){.ki-filter-form{grid-template-columns:1fr 1fr}.ki-kpis{grid-template-columns:repeat(2,minmax(0,1fr))}.ki-main-grid{grid-template-columns:1fr}.ki-news-panel{grid-column:auto}.ki-news{grid-template-columns:1fr}.ki-products{grid-template-columns:repeat(3,minmax(0,1fr))}.ki-hero-copy{padding:27px}.ki-hero:after{right:-40px;opacity:.55}}
@media(max-width:520px){.ki-filter-form{grid-template-columns:1fr}.ki-kpi{padding:12px;gap:8px}.ki-kpi-icon{width:35px;height:35px;flex-basis:35px}.ki-kpi-value{font-size:22px}.ki-products{grid-template-columns:repeat(2,minmax(0,1fr))}.ki-sentra-banner{align-items:flex-start;flex-direction:column}.ki-sentra-banner:after{right:-40px}}
</style>
@endpush

@section('content')
@php
    $rekapTotal = (int)$terdaftar + (int)$proses;
    $jenisLabels = $jumlahPerJenis->pluck('nama_jenis')->values();
    $jenisValues = $jumlahPerJenis->pluck('total')->map(fn($n)=>(int)$n)->values();
@endphp
<div class="ki-dash">
    {{-- Filter dashboard sebelumnya tetap dipertahankan --}}
    

    <section class="ki-hero" id="kiHero">
        <div class="ki-hero-copy">
            <div class="ki-kicker">Produk Kekayaan Intelektual Unggulan</div>
            <h1 id="kiHeroTitle">Karya Taylor Swift,<br>Untuk Kalimantan Tengah</h1>
            <p id="kiHeroText">Inovasi masyarakat, kekayaan untuk masa depan.</p>
            <a class="ki-hero-link" href="{{ route('galeri-ki.index') }}">Lihat Selengkapnya <span>→</span></a>
        </div>
        <div class="ki-hero-controls"><button class="active" type="button" aria-label="Slide 1"></button><button type="button" aria-label="Slide 2"></button><button type="button" aria-label="Slide 3"></button></div>
    </section>

    <section class="ki-panel ki-filter">
        <form class="ki-filter-form" method="GET" action="{{ url('/') }}">
            <div class="ki-field"><label for="jenis_ki_id">Jenis Kekayaan Intelektual</label><select name="jenis_ki_id" id="jenis_ki_id"><option value="">Semua Jenis KI</option>@foreach($jenisKI as $jenis)<option value="{{ $jenis->id }}" {{ (string)$jenisKiId === (string)$jenis->id ? 'selected' : '' }}>{{ $jenis->nama_jenis }}</option>@endforeach</select></div>
            <div class="ki-field"><label for="kabupaten_id">Kabupaten/Kota</label><select name="kabupaten_id" id="kabupaten_id"><option value="">Semua Kabupaten/Kota</option>@foreach($daftarKabupaten as $kab)<option value="{{ $kab->id }}" {{ (string)$kabupatenId === (string)$kab->id ? 'selected' : '' }}>{{ $kab->nama_kabupaten }}</option>@endforeach</select></div>
            <button class="ki-btn" type="submit">Terapkan Filter</button><a class="ki-btn light" href="{{ url('/') }}">Reset</a>
        </form>
    </section>

    <section class="ki-kpis">
        <div class="ki-panel ki-kpi"><div class="ki-kpi-icon blue">▤</div><div><div class="ki-kpi-label">Total KI (Rekap)</div><div class="ki-kpi-value">{{ number_format($rekapTotal,0,',','.') }}</div><div class="ki-kpi-note">Terdaftar + Dalam Proses</div></div></div>
        <div class="ki-panel ki-kpi"><div class="ki-kpi-icon green">✓</div><div><div class="ki-kpi-label">Terdaftar</div><div class="ki-kpi-value">{{ number_format($terdaftar,0,',','.') }}</div><div class="ki-kpi-note">Data KI terdaftar</div></div></div>
        <div class="ki-panel ki-kpi"><div class="ki-kpi-icon amber">◷</div><div><div class="ki-kpi-label">Dalam Proses</div><div class="ki-kpi-value">{{ number_format($proses,0,',','.') }}</div><div class="ki-kpi-note">Data KI dalam proses</div></div></div>
        <div class="ki-panel ki-kpi"><div class="ki-kpi-icon pink">▥</div><div><div class="ki-kpi-label">Potensi KI</div><div class="ki-kpi-value">{{ number_format($potensi,0,',','.') }}</div><div class="ki-kpi-note">Dihitung terpisah dari rekap</div></div></div>
    </section>

    <section class="ki-main-grid">
        <div class="ki-panel">
            <div class="ki-panel-head"><h2 class="ki-panel-title">Data KI per Jenis</h2></div>
            <div class="ki-chart"><canvas id="kiByTypeChart"></canvas></div>
        </div>
        <div class="ki-panel">
            <div class="ki-panel-head"><h2 class="ki-panel-title">Status KI</h2></div>
            <div class="ki-status-content"><div class="ki-donut"><canvas id="kiStatusChart"></canvas></div>
                <div class="ki-legend">
                    <div class="ki-legend-row"><span class="ki-dot" style="background:#3479d7"></span>Terdaftar<strong>{{ number_format($terdaftar,0,',','.') }}</strong></div>
                    <div class="ki-legend-row"><span class="ki-dot" style="background:#f5ad2f"></span>Dalam Proses<strong>{{ number_format($proses,0,',','.') }}</strong></div>
                    <div class="ki-legend-row"><span class="ki-dot" style="background:#ed4b79"></span>Potensi<strong>{{ number_format($potensi,0,',','.') }}</strong></div>
                </div>
            </div>
        </div>
       
<div class="ki-panel">
    <div class="ki-panel-heading">
        <h3>Potensi KI Diterima</h3>
        <a href="{{ route('potensi-ki.index') }}">
            Lihat Semua &rarr;
        </a>
    </div>

    <div class="ki-potential-list">
        @forelse ($potensiMenungguTelaah as $item)
            <div class="ki-potential-item">
                <div class="ki-potential-icon">
                    <i class="fas fa-file-alt"></i>
                </div>

                <div class="ki-potential-info">
                    <div class="ki-potential-name">
                        {{ $item->nama_ki ?? $item->nama ?? '-' }}
                    </div>

                    <div class="ki-potential-type">
                        {{ $item->jenisKi->nama_jenis ?? 'Jenis KI belum tersedia' }}
                    </div>
                </div>

                <span class="ki-potential-status">
                    Diterima
                </span>
            </div>
        @empty
            <p class="text-muted">
                Belum ada potensi KI yang diterima.
            </p>
        @endforelse
    </div>
</div>

    </section>

    <section class="ki-bottom">
        <div class="ki-panel">
            <div class="ki-panel-head"><h2 class="ki-panel-title">Produk KI Unggulan</h2><a class="ki-btn light" href="{{ route('galeri-ki.index') }}">Lihat Semua →</a></div>
            @if($produkUnggulan->count())
            <div class="ki-products">
                @foreach($produkUnggulan as $item)
                <article><div class="ki-product-img"><img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->nama_produk }}"></div><div class="ki-product-title">{{ $item->nama_produk }}</div><span class="ki-product-type">{{ $item->nama_jenis ?? 'Jenis KI' }}</span><div class="ki-news-sub">{{ \Illuminate\Support\Str::limit($item->caption,75) }}</div></article>
                @endforeach
            </div>
            @else
            <p class="ki-empty">Belum ada produk unggulan. Master dapat menandai produk sebagai unggulan di menu Galeri Produk KI.</p>
            @endif
        </div>
        <a class="ki-sentra-banner" href="{{ route('sentra-ki.index') }}">
            <div class="ki-sentra-copy"><div class="ki-sentra-kicker">KOLABORASI DAN PENDAMPINGAN</div><div class="ki-sentra-title">Kenali Sentra KI Kalimantan Tengah</div><div class="ki-sentra-desc">Temukan pusat pendampingan dan pengembangan Kekayaan Intelektual di Kalimantan Tengah.</div></div><span class="ki-sentra-cta">Jelajahi Sentra KI →</span>
        </a>
    </section>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded',function(){
 const labels=@json($jenisLabels), values=@json($jenisValues);
 
const byType = document.getElementById('kiByTypeChart');

if (byType) {
    new Chart(byType, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah KI Rekap',
                data: values,
                backgroundColor: [
                    '#6da4ed',
                    '#f45d7c',
                    '#3179de',
                    '#ffb12c',
                    '#8b70d6',
                    '#46a9b9',
                    '#7ba65b'
                ],
                borderRadius: 5,
                maxBarThickness: 28,
                minBarLength: 4
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    right: 35
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Jumlah: ' +
                                Number(context.raw).toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        color: '#8191a6'
                    },
                    grid: {
                        color: '#edf1f6'
                    }
                },
                y: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#536985',
                        font: {
                            size: 11
                        }
                    }
                }
            }
        },
        plugins: [{
            id: 'angkaUjungBatang',
            afterDatasetsDraw(chart) {
                const ctx = chart.ctx;
                const dataset = chart.data.datasets[0];
                const meta = chart.getDatasetMeta(0);

                ctx.save();
                ctx.font = 'bold 11px Arial';
                ctx.fillStyle = '#17365e';
                ctx.textAlign = 'left';
                ctx.textBaseline = 'middle';

                meta.data.forEach((bar, index) => {
                    const value = Number(dataset.data[index]);
                    const x = Math.max(
                        bar.x + 6,
                        bar.base + 6
                    );
                    ctx.fillText(
                        value.toLocaleString('id-ID'),
                        x,
                        bar.y
                    );
                });

                ctx.restore();
            }
        }]
    });
}

 const status=document.getElementById('kiStatusChart');
 if(status){new Chart(status,{type:'doughnut',data:{labels:['Terdaftar','Dalam Proses','Potensi'],datasets:[{data:[{{ (int)$terdaftar }},{{ (int)$proses }},{{ (int)$potensi }}],backgroundColor:['#3479d7','#f5ad2f','#ed4b79'],borderColor:'#fff',borderWidth:3}]},options:{responsive:true,maintainAspectRatio:false,cutout:'70%',plugins:{legend:{display:false}}}});}
 const slides=[
  {title:'Karya Lokal,<br>Untuk Kalimantan Tengah',text:'Inovasi masyarakat, kekayaan untuk masa depan.'},
  {title:'Lindungi Karya,<br>Perkuat Inovasi',text:'Kenali dan dukung Kekayaan Intelektual masyarakat Kalimantan Tengah.'},
  {title:'Dari Ide Menjadi<br>Karya yang Bernilai',text:'Temukan produk dan potensi kreatif dari seluruh wilayah Kalimantan Tengah.'}
 ];
 const hero=document.getElementById('kiHero'), title=document.getElementById('kiHeroTitle'), desc=document.getElementById('kiHeroText'), dots=[...document.querySelectorAll('.ki-hero-controls button')];let idx=0;
 function show(i){idx=i%slides.length;title.innerHTML=slides[idx].title;desc.textContent=slides[idx].text;dots.forEach((d,j)=>d.classList.toggle('active',j===idx));}
 dots.forEach((d,i)=>d.addEventListener('click',()=>show(i)));setInterval(()=>show((idx+1)%slides.length),6000);
});
</script>
@endpush
