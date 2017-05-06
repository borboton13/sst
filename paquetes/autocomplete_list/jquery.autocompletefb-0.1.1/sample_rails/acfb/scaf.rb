p 'boot'; require 'config/boot'
p 'envi'; require 'config/environment'
p 'genr'; require 'rails_generator'
p 'gent'; require 'rails_generator/scripts/generate'
p 'Init Scaffold Array'
arg = []
arg<< %w[
	scaffold product
		ref:string 
		ean:string 
		nicname:string 
		longname:string 
		protype_id:integer
		probrand_id:integer
		procategory_id:integer
		pro_unit:string
		qty_min:integer
		qty_max:integer
		price_buy:integer
		price_sell:integer
		discount:integer
		point:integer
		valid_start:date
		valid_end:date]
arg<< %w[
	scaffold protype
		nicname:string 
		longname:string]
arg<< %w[
	scaffold probrand 
		nicname:string 
		longname:string 
		obselete:integer]
arg<< %w[
	scaffold procategory
		nicname:string 
		longname:string 
		obselete:integer]
p 'Execute Scaffold Generator'
arg.each{|x|Rails::Generator::Scripts::Generate.new.run(x)}
