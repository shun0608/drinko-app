<template>
  <div class="bg-drink relative flex justify-center items-center">
    <div class="bg-white w-full max-w-3xl rounded-3xl px-4 py-6 my-10">
      <h1 class="text-4xl font-bold text-center mt-14">
        <slot name="form-title" />
      </h1>
      <slot name="content" />
    </div>
  </div>
</template>
