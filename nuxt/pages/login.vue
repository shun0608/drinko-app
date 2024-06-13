<template>
  <div>
    <div>
      <form>
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
import { ref } from "vue";
import { useForm, useField } from "vee-validate";
import * as yup from "yup";
const { $sanctumAuth } = useNuxtApp();
const errors = ref([]);

definePageMeta({
  middleware: "guest",
});

const { value: email, errorMessage: emailError } = useField(
  "email",
  yup
    .string()
    .required("この項目は必須です")
    .email("メールアドレスの形式で入力してください")
);
const { value: password, errorMessage: passwordError } = useField(
  "password",
  yup.string().required("この項目は必須です")
);

const login = async () => {
  try {
    await $sanctumAuth.login(
      {
        email: email.value,
        password: password.value,
      },
      // optional callback function
      (data) => {
        navigateTo("/", {
          external: true,
        });
      }
    );
  } catch (e) {
    errors.value = e.errors;
    console.log(errors.value);
  }
};
</script>

<style scoped></style>
