@props(['guess'])
@php $jots = $guess->jots ?? null; @endphp
<span>{{$jots === 6 ? 'JOTTO' : $jots}}</span>
