@php use App\Models\Intervention; @endphp
@php
    /**
     * @var Intervention $intervention
     * */
@endphp
<x-layout.mail-layout>
    <style>
        .main {
            padding: 2rem;
        }

        .title {
            font-size: 24px;
            color: #3D2B1F;
            margin: 0 0 12px;
        }

        .intro {
            margin: 0 0 2rem;
            font-size: 14px;
            color: #6c6d6e;
            line-height: 1.7;
        }

        .section-title {
            margin: 0 0 1rem;
            font-size: 16px;
            font-weight: 500;
            color: #3D2B1F;
        }

        .info {
            background-color: #f6f6f6;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            margin: 0 0 2rem;
            border: 1px solid #cfcfcf;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 0;
        }

        .info-divider {
            border-top: 1px solid #cfcfcf;
            margin: 4px 0;
        }

        .info-label {
            font-size: 14px;
            font-weight: 600;
            color: #6c6d6e;
        }

        .info-value {
            font-size: 14px;
            font-weight: 500;
            color: #57A770;
        }

        .notice {
            background-color: #F8D2C9;
            border-radius: 8px;
            padding: 1rem;
            font-size: 14px;
            line-height: 1.4;
            color: #C6390E;
        }

        .message {
            background-color: #f6f6f6;
            border-radius: 8px;
            padding: 1rem;
            border: 1px solid #cfcfcf;
            font-size: 14px;
            color: #3D2B1F;
            line-height: 1.7;
        }
    </style>

    <main class="main">

        <h2 class="title">Une intervention vous a été assignée !</h2>

        <p class="intro">
            Bonjour {{ $intervention->assignee->first_name }}, une nouvelle intervention vient de vous être attribuée.
        </p>

        <section>
            <h2 class="section-title">Détails de l’intervention</h2>
            <div class="info">
                <div class="info-row">
                    <span class="info-label">Intervention</span>
                    <span class="info-value">{{ $intervention->name }}</span>
                </div>
                <div class="info-divider"></div>
                <div class="info-row">
                    <span class="info-label">Assignée à</span>
                    <span class="info-value">{{ $intervention->assignee->full_name }}</span>
                </div>
                <div class="info-divider"></div>
                <div class="info-row">
                    <span class="info-label">Assignée le</span>
                    <span class="info-value">{{ formattedDate($intervention->created_at)  }}</span>
                </div>
            </div>
        </section>

        @if($intervention->description)
            <section>
                <h2 class="section-title">Description</h2>

                <p class="message">
                    {{ $intervention->description }}
                </p>
            </section>
        @endif

        <div class="notice">
            <strong>Rappel :</strong> pensez à marquer cette intervention comme complétée une fois celle-ci effectuée.
        </div>

    </main>
</x-layout.mail-layout>
