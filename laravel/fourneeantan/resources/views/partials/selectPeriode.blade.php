
        <label for="cxDate">Type de statistique :</label>
        <select name="cxDate" onchange="this.form.submit();" class="w-56 text-center">
            @switch($cxDate)
                @case('day')
                    <option value="day" selected>Journée en cours</option>
                    <option value="yesterday">Hier</option>
                    <option value="week">Cette semaine</option>
                    <option value="lastWeek">Semaine dernière</option>
                    <option value="month">Mois en cours</option>
                    <option value="year">Année en cours</option>
                    @break
                @case('yesterday')
                    <option value="day">Journée en cours</option>
                    <option value="yesterday" selected>Hier</option>
                    <option value="week">Cette semaine</option>
                    <option value="lastWeek">Semaine dernière</option>
                    <option value="month">Mois en cours</option>
                    <option value="year">Année en cours</option>
                    @break
                @case('week')
                    <option value="day">Journée en cours</option>
                    <option value="yesterday">Hier</option>
                    <option value="week" selected>Cette semaine</option>
                    <option value="lastWeek">Semaine dernière</option>
                    <option value="month">Mois en cours</option>
                    <option value="year">Année en cours</option>
                    @break
                @case('lastWeek')
                    <option value="day">Journée en cours</option>
                    <option value="yesterday">Hier</option>
                    <option value="week">Cette semaine</option>
                    <option value="lastWeek"selected>Semaine dernière</option>
                    <option value="month">Mois en cours</option>
                    <option value="year">Année en cours</option>
                    @break
                @case('month')
                    <option value="day">Journée en cours</option>
                    <option value="yesterday">Hier</option>
                    <option value="week">Cette semaine</option>
                    <option value="lastWeek">Semaine dernière</option>
                    <option value="month"selected>Mois en cours</option>
                    <option value="year">Année en cours</option>
                    @break                                                
                @case('year')
                    <option value="day">Journée en cours</option>
                    <option value="yesterday">Hier</option>
                    <option value="week">Cette semaine</option>
                    <option value="lastWeek">Semaine dernière</option>
                    <option value="month">Mois en cours</option>
                    <option value="year" selected>Année en cours</option>
                    @break   
                @default
                    <option value="day">Journée en cours</option>
                    <option value="yesterday">Hier</option>
                    <option value="week">Cette semaine</option>
                    <option value="lastWeek">Semaine dernière</option>
                    <option value="month">Mois en cours</option>
                    <option value="year">Année en cours</option>
            @endswitch
        </select>
