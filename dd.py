import pandas as pd
from sklearn.preprocessing import StandardScaler
from sklearn.decomposition import PCA
from sklearn.ensemble import RandomForestClassifier

args_df = pd.read_csv("C:/xampp/htdocs/HMS/remaining_dataset.csv", header=None)

df = pd.read_csv("C:/xampp/htdocs/HMS/diabetes_preprocessed2_v4.0.csv")

# Separate the features and target variable in the preprocessed data
y = df["CLASS"]
X = df.drop(columns="CLASS")

# Preprocess the remaining dataset using the same transformations as the preprocessed data
sc = StandardScaler()
X_scaled = sc.fit_transform(X)

pca = PCA(n_components=0.95)
X_scaled_pca = pca.fit_transform(X_scaled)

best_params = {
    'max_depth': 10,
    'min_samples_split': 2,
    'n_estimators': 50
}

rf = RandomForestClassifier(random_state=100, **best_params)
rf.fit(X_scaled_pca, y)

predictions = []

for index, row in args_df.iterrows():
    new_data = [row.values]
    new_data_df = pd.DataFrame(new_data, columns=X.columns)

    # Preprocess the new data using the same transformations as the preprocessed data
    new_data_scaled = sc.transform(new_data_df)
    new_data_scaled_pca = pca.transform(new_data_scaled)

    prediction = rf.predict(new_data_scaled_pca)
    predictions.append(prediction[0])

output_df = pd.DataFrame({"Prediction": predictions})

output_df.to_csv("C:/xampp/htdocs/HMS/predictions.csv", index=False)
