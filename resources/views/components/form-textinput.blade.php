@props([
    'name',
    'label',
    'placeholder' => '',
    'value' => '',
])

<div>
    <label class="font-semibold text-xs" for="{{$name}}">{{$label}}</label><br/>
    <input type="text" name="{{$name}}" class="border @error($name) border-red-500 @else border-black @endif" placeholder="{{$placeholder}}" value="{{old($name,$value)}}" required>
    @error($name) <div class="text-red-500"> {{$message}} </div> @enderror
</div>
