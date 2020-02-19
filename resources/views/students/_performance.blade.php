    <h3>Student Performance</h3>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link {{$myClass->grading==1?'active':''}}" id="Midterm-tab" data-toggle="tab" href="#Midterm" role="tab" aria-controls="Midterm" aria-selected="{{$myClass->grading==1?'true':'false'}}">Midterm</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{$myClass->grading==2?'active':''}}" id="Final-tab" data-toggle="tab" href="#Final" role="tab" aria-controls="Final" aria-selected="{{$myClass->grading==2?'true':'false'}}">Final</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="summary-tab" data-toggle="tab" href="#summary" role="tab" aria-controls="summary" aria-selected="false">Summary</a>
            </li>
        </ul>

        <?php $pct = [
            1 => [
                'quiz'=>'0',
                'participation'=>'0',
                'exam'=>'0'
            ],
            2 => [
                'quiz'=>'0',
                'participation'=>'0',
                'exam'=>'0'
            ],
        ]; ?>
        <div class="tab-content" id="myTabContent">
            @foreach([1=>'Midterm',2=>'Final'] as $grading=>$term)
            <div class="tab-pane fade {{$myClass->grading==$grading?'show active':''}}" id="{{$term}}" role="tabpanel" aria-labelledby="{{$term}}-tab">
                <br>
                @foreach($$term as $component=>$gdSummary)
                    <h4 style="text-transform: capitalize">{{$component}}</h4>
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr class="bg-info">
                                <th>Date/Title</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Score</th>
                                <th class="text-center">Percent</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $totScore=0; $total=0; ?>
                            @foreach($gdSummary as $score)
                            <tr>
                                <td>
                                    {{$score->column->created_at->format('M-d')}}
                                    | {{$score->column->title}}
                                </td>
                                <td class="text-center">{{$score->column->total}}</td>
                                <td class="text-center">{{$score->score}}</td>
                                <td class="text-center">
                                    @if($score->column->total > 0)
                                    {{number_format(($score->score/$score->column->total)*100,2)}}%
                                    @endif
                                </td>
                            </tr>
                            <?php $totScore += $score->score; $total+=$score->column->total; ?>
                            @endforeach
                            <tr class="bg-light">
                                <th>TOTALS</th>
                                <td class="text-center">{{$total}}</td>
                                <td class="text-center">{{$totScore}}</td>
                                <td class="text-center">
                                    @if($total>0)
                                    {{ number_format(($pct[$grading][$component]=$totScore/$total)*100,2) }}%
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @endforeach
            </div>
            @endforeach

            <div class="tab-pane fade" id="summary" role="tabpanel" aria-labelledby="summary-tab">
                <br>
                <h3>Summary</h3>
                <table class="table table-striped">
                    <thead class="bg-info">
                        <tr>
                            <th rowspan="2">Component</th>
                            <th colspan="2" class="text-center">Weighted Score</th>
                        </tr>
                        <tr>
                            <th class="text-center">Midterm</th>
                            <th class="text-center">Final</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $mtws = 0; $ftws=0; ?>
                        @foreach(['quiz'=>'quiz','part'=>'participation','exam'=>'exam'] as $c=>$comp)
                        <tr>
                            <?php $wname = $c . "_weight"; ?>
                            <td><span style="text-transform: capitalize">{{$comp}}</span></td>
                            <td class="text-center">{{ number_format($m = $pct[1][$comp] * $enrol->myClass->$wname, 2)}}</td>
                            <td class="text-center">{{ number_format($f = $pct[2][$comp] * $enrol->myClass->$wname, 2)}}</td>
                            <?php $mtws+=$m; $ftws+=$f; ?>
                        </tr>
                        @endforeach
                        <tr>
                            <th>TOTAL</th>
                            <?php $totalWeights = $enrol->myClass->totalWeights; ?>
                            <td class="text-center">{{ number_format($mgrade = ($mtws/$totalWeights)*100, 2)}}%</td>
                            <td class="text-center">{{ number_format($fgrade = ($ftws/$totalWeights)*100, 2)}}%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
