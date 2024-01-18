const form = document.querySelector('.edit__noticias form')
const result = document.querySelector('.result')

async function ajax(config) {
  try {
    const request = await fetch(config.url, config.headers)
    const response = await request.json()

    config.success(response)
  } catch (err) {
    config.error(err)
  }
}

function handleSubmitProfile(e) {
  e.preventDefault()

  const { name, texto, image } = form

  const formData = new FormData(this)

  formData.append('name', name.value)
  formData.append('texto', texto.value)
  formData.append('image', image.value)

  const url = window.location.href

  ajax({
    url: '../update-noticias',
    headers: {
      body: formData,
      method: 'POST'
    },
    success(data) {
      if (data?.error) {
        result.innerHTML = `<div class="msg error">${data.error}</div>`
        setTimeout(() => result.innerHTML = '', 2000)
      } else if (data?.success) {
        result.innerHTML = `<div class="msg success">${data.success}</div>`
        setTimeout(() => window.location.href = url, 2000)
      }
    },
    error(err) {
      console.log(err)
    }
  })
}

form.addEventListener('submit', handleSubmitProfile)