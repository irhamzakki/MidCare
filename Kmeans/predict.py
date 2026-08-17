import sys
import json
import os
import joblib
import numpy as np


# ==========================================================
# 1. Lokasi folder Kmeans
# ==========================================================

BASE_DIR = os.path.dirname(os.path.abspath(__file__))


# ==========================================================
# 2. Load model dan konfigurasi
# ==========================================================

MODEL_PATH = os.path.join(BASE_DIR, "kmeans_model.pkl")
SCALER_PATH = os.path.join(BASE_DIR, "scaler_model.pkl")
CONFIG_PATH = os.path.join(BASE_DIR, "model_config.json")


model = joblib.load(MODEL_PATH)
scaler = joblib.load(SCALER_PATH)

with open(CONFIG_PATH, "r", encoding="utf-8") as file:
    config = json.load(file)


# ==========================================================
# 3. Ambil konfigurasi
# ==========================================================

selected_features = config["selected_features"]
cluster_mapping = config["cluster_mapping"]


# ==========================================================
# 4. Ambil data dari Laravel atau STDIN
# ==========================================================

try:
    if len(sys.argv) > 1:
        raw_input = sys.argv[1]
    else:
        raw_input = sys.stdin.read().strip()

    input_data = json.loads(raw_input)

except Exception as e:
    print(json.dumps({
        "success": False,
        "message": "Format data input tidak valid.",
        "received": raw_input if 'raw_input' in locals() else "",
        "error": str(e)
    }, ensure_ascii=False))
    sys.exit(1)

# ==========================================================
# 5. Validasi fitur
# ==========================================================

missing_features = []

for feature in selected_features:
    if feature not in input_data:
        missing_features.append(feature)


if missing_features:
    print(json.dumps({
        "success": False,
        "message": "Fitur tidak lengkap.",
        "missing_features": missing_features
    }))
    sys.exit(1)


# ==========================================================
# 6. Susun fitur sesuai urutan model
# ==========================================================

data = []

for feature in selected_features:
    value = input_data[feature]

    if value is None or value == "":
        print(json.dumps({
            "success": False,
            "message": f"Nilai fitur '{feature}' kosong."
        }))
        sys.exit(1)

    try:
        data.append(float(value))
    except ValueError:
        print(json.dumps({
            "success": False,
            "message": f"Nilai fitur '{feature}' harus berupa angka."
        }))
        sys.exit(1)


# ==========================================================
# 7. Bentuk array
# ==========================================================

X = np.array(data, dtype=float).reshape(1, -1)


# ==========================================================
# 8. Scaling
# ==========================================================

X_scaled = scaler.transform(X)


# ==========================================================
# 9. Prediksi K-Means
# ==========================================================

cluster = int(model.predict(X_scaled)[0])


# ==========================================================
# 10. Mapping cluster ke kategori risiko
# ==========================================================

risiko = cluster_mapping.get(
    str(cluster),
    "Kategori risiko tidak ditemukan"
)


# ==========================================================
# 11. Output ke Laravel
# ==========================================================

result = {
    "success": True,
    "cluster": cluster,
    "risiko": risiko,
    "features": {
        selected_features[i]: data[i]
        for i in range(len(selected_features))
    }
}


print(json.dumps(result, ensure_ascii=False))