<template>
  <div>
    <div>
      <form action="">
        <dl>
          <dt>メールアドレス</dt>
          <dd>
            <input id="email" type="string" v-model="email" />
          </dd>
        </dl>
        <dl>
          <dt>
            <label for="password">パスワード</label>
          </dt>
          <dd><input id="password" type="password" v-model="password" /></dd>
        </dl>
        <button type="button" @click="login">ログイン</button>
      </form>
    </div>
  </div>
</template>

<script setup>
definePageMeta({
  middleware: "guest",
});
const { $sanctumAuth } = useNuxtApp();
const router = useRouter();
const login = async () => {
  await $sanctumAuth.login({
    email: "test@test.com",
    password: "password",
  });
};
</script>

<style scoped></style>
