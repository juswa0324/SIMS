export async function postData(url, data = {}) {
  try {
    let body;
    let useFormData = false;

    //detect files
    for (const key in data) {
      const value = data[key];

      if (
        value instanceof File ||
        value instanceof Blob ||
        (value instanceof FileList && value.length > 0)
      ) {
        useFormData = true;
        break;
      }

      if (useFormData) {
        body = new FormData();

        for (const key in data) {
          const value = data[key];

          if (value instanceof File) {
            body.append(key, value);
          } else if (value instanceof FileList) {
            for (let i = 0; i < value.length; i++) {
              body.append(`${key}[]`, value[i]);
            }
          } else if (typeof value === "object" && value !== null) {
            //fix stringify objects and arrays
            body.append(key, JSON.stringify(value));
          } else {
            body.append(key, value);
          }
        }
      } else {
        body = new URLSearchParams();

        for (const key in data) {
          const value = data[key];

          if (typeof value === "object" && value !== null) {
            //fix stringify objects and arrays
            body.append(key, JSON.stringify(value));
          } else {
            body.append(key, value);
          }
        }
      }
    }

    const response = await fetch(url, {
      method: "POST",
      headers: useFormData
        ? undefined
        : { "Content-Type": "application/x-www-form-urlencoded" },
      body,
    });

    const result = await response.json(); // parse once

    if (!response.ok) {
      throw result; //throw backend response
    }

    return result;
  } catch (err) {
    console.error("Post Error: ", err);
    throw err;
  }
}

export async function getData(url) {
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`HTTP Error: ${response.status}`);
    }
    return await response.json();
  } catch (err) {
    console.error("GET Error: ", err);
    throw err;
  }
}

export function showLoader() {
  document.getElementById("loading").style.display = "flex";
}

export function hideLoader() {
  document.getElementById("loading").style.display = "none";
}

export function hideButton(button) {
  document.getElementById(button).style.display = "none";
}

export function showButton(button) {
  document.getElementById(button).style.display = "block";
}
