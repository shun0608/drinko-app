<script setup>
definePageMeta({
  middleware: "auth",
});
const { $apiFetch } = useNuxtApp();
const { user } = useAuth();
const { $toast } = useNuxtApp();
const showToast = (message, type) => {
  $toast.open({
    message,
    type: type,
  });
};

const userDelete = async () => {
  try {
    await $apiFetch(`/api/users/${user.id}`, {
      method: "DELETE",
    });
    location.href = "/" + "?delete=true";
  } catch (e) {
    console.log(e);
    showToast(
      "処理中にエラーが発生しました。再度退会手続きを行ってください。",
      "error"
    );
  }
};
</script>

<template>
  <auth-white-back>
    <template #form-title>退会手続き</template>
    <template #content>
      <p class="mt-10 text-center">
        退会をするとお気に入りに追加したドリンクの情報も全て削除されます。
      </p>
      <p class="mt-5 text-center">それでも退会をしますか？</p>
      <div class="flex justify-center gap-4 mt-10">
        <button class="btn btn-neutral w-36" onclick="my_modal_3.showModal()">
          退会する
        </button>
        <dialog id="my_modal_3" class="modal">
          <div class="modal-box">
            <form method="dialog">
              <button
                class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
              >
                ✕
              </button>
            </form>
            <h3 class="font-bold text-lg">最終確認</h3>
            <p class="py-4">この操作は取り消せません。本当に退会しますか？</p>
            <div class="flex gap-4">
              <button class="btn btn-neutral w-28" @click="userDelete()">
                退会する
              </button>
              <form method="dialog">
                <button class="btn w-28">キャンセル</button>
              </form>
            </div>
          </div>
        </dialog>
        <NuxtLink class="btn w-36" href="/">キャンセル</NuxtLink>
        <span class="block h-20"></span>
      </div>
      <div class="mb-5"></div>
    </template>
  </auth-white-back>
</template>
