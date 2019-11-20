package model;

public class Cachorro {
    String dono, raca;
    int idade, peso;

    public Cachorro(String dono, String raca, int idade, int peso) {
        this.dono = dono;
        this.raca = raca;
        this.idade = idade;
        this.peso = peso;
    }

    public String getDono() {
        return dono;
    }

    public void setDono(String dono) {
        this.dono = dono;
    }

    public String getRaca() {
        return raca;
    }

    public void setRaca(String raca) {
        this.raca = raca;
    }

    public int getIdade() {
        return idade;
    }

    public void setIdade(int idade) {
        this.idade = idade;
    }

    public int getPeso() {
        return peso;
    }

    public void setPeso(int peso) {
        this.peso = peso;
    }
    
}
