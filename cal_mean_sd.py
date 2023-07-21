import pandas as pd

# Read the CSV file
data = pd.read_csv("C:/xampp/htdocs/HMS/Diabetes2.csv")

# Calculate mean and standard deviation for each variable
statistics = data.describe().loc[['mean', 'std']].transpose()

# Print the mean and standard deviation for each variable
print(statistics)
