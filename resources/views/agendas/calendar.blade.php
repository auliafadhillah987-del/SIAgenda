@extends('layouts.app')

@section('content')
<div class="py-6 relative z-10">
    <div class="mb-10">
        <h1 class="text-3xl font-extrabold text-[color:var(--dark)] tracking-tight">Kalender Agenda</h1>
        <p class="text-[color:var(--dark)]/60 font-bold mt-1">Pantau semua jadwal sekolah dalam tampilan bulanan.</p>
    </div>

    <div class="bg-white p-8 rounded-[32px] shadow-sm border border-slate-50">
        <div id='calendar'></div>
    </div>
</div>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            
            // Check role from blade
            var hasPermissionToCreate = @json(Auth::user()->hasRole('administrator') || Auth::user()->hasRole('guru/staff'));
            
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek'
                },
                editable: false,
                droppable: false,
                events: @json($agendas), // Data dari Controller
                
                // Penyesuaian Bahasa Indonesia
                locale: 'id', 
                buttonText: {
                    today: 'Hari Ini',
                    month: 'Bulan',
                    week: 'Minggu'
                },

                dateClick: function(info) {
                    if (hasPermissionToCreate) {
                        window.location.href = "{{ route('agendas.create') }}?date=" + info.dateStr;
                    } else {
                        alert('Anda tidak memiliki akses untuk menambah agenda.');
                    }
                },
                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    if (info.event.url) {
                        window.location.href = info.event.url;
                    }
                }
            });
            calendar.render();
        });
    </script>

    <style>
        /* Custom CSS agar senada dengan UI Dashboard Neo-Brutalism */
        .fc .fc-toolbar-title { font-weight: 900; color: var(--dark); font-size: 1.5rem; text-transform: uppercase; letter-spacing: 1px; }
        .fc .fc-button-primary { 
            background-color: var(--brick); 
            border: 3px solid var(--dark); 
            border-radius: 12px; 
            font-weight: 800;
            padding: 8px 16px;
            box-shadow: 4px 4px 0px var(--dark);
            color: white !important;
            text-transform: uppercase;
            transition: all 0.2s;
        }
        .fc .fc-button-primary:not(:disabled):hover { 
            background-color: var(--orange); 
            color: var(--dark) !important;
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px var(--dark);
        }
        .fc .fc-button-primary:not(:disabled):active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px var(--dark);
        }
        .fc .fc-button-primary:disabled { background-color: #cbd5e1; border-color: #94a3b8; box-shadow: none; color: #64748b !important; }
        
        .fc .fc-daygrid-day-number { 
            font-weight: 800; 
            color: var(--dark); 
            padding: 8px;
            text-decoration: none;
            font-size: 1rem;
        }
        
        .fc .fc-event { 
            border-radius: 8px; 
            padding: 4px 8px; 
            font-size: 12px; 
            font-weight: 800;
            border: 2px solid var(--dark) !important;
            box-shadow: 3px 3px 0px var(--dark);
            margin: 2px 4px;
            color: var(--dark) !important;
            transition: transform 0.2s;
        }
        
        .fc .fc-event:hover {
            transform: scale(1.05);
            z-index: 10;
        }

        .fc-theme-standard td, .fc-theme-standard th { border-color: var(--dark); border-width: 2px; }
        .fc-theme-standard .fc-scrollgrid { border: 3px solid var(--dark); border-radius: 16px; overflow: hidden; box-shadow: 8px 8px 0px var(--dark); }
    </style>
@endsection