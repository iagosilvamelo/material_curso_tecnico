package model;

public class Animal implements mvc.Model{
    private String tipo, nome, dono, idade;

    public Animal(String tipo, String nome, String dono, String idade) {
        this.tipo = tipo;
        this.nome = nome;
        this.dono = dono;
        this.idade = idade;
    }

    public String getTipo() {
        return tipo;
    }

    public void setTipo(String tipo) {
        this.tipo = tipo;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getDono() {
        return dono;
    }

    public void setDono(String dono) {
        this.dono = dono;
    }

    public String getIdade() {
        return idade;
    }

    public void setIdade(String idade) {
        this.idade = idade;
    }
    
}
