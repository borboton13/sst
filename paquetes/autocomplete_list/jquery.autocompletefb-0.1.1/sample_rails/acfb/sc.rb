p 'boot'; require 'config/boot'
p 'envi'; require 'config/environment'
p 'genr'; require 'rails_generator'
p 'gent'; require 'rails_generator/scripts/generate'

#ARGV.shift if ['--help', '-h'].include?(ARGV[0])
#p 'Generate Rails'
#Rails::Generator::Base.use_application_sources!
#Rails::Generator::Scripts::Generate.new.run(%w[../test_03 -dsqlite3], :generator => 'app')
#puts %x[copy *.rb  ..\\test_03]
#puts %x[copy *.bat ..\\test_03]
#puts %x[xcopy /s /e /y /I vendor ..\\test_03\\vendor]
#Dir.chdir(app_path)
#p "../test_03/config/environment"
#p 'boot2'; require '../test_03/config/boot'
#p 'envi2'; require "../test_03/config/environment"
#p 'genr2'; require 'rails_generator'
#p 'gent2'; require 'rails_generator/scripts/generate'
p 'Init Scaffold Array'
arg = []
arg<< %w[
	scaffold contact0 
		name:string 
		email:string 
		phone:string 
		address_line1:string 
		address_line2:string 
		city:string 
		state:string 
		country:string]
arg<< %w[
	scaffold contact1
		name:string 
		email:string 
		phone:string 
		address_line1:string 
		address_line2:string 
		city:string 
		state:string 
		country:string]
arg<< %w[
	scaffold contact2 
		name:string 
		email:string 
		phone:string 
		address_line1:string 
		address_line2:string 
		city:string 
		state:string 
		country:string]
p 'Execute Scaffold Generator'
arg.each{|x|Rails::Generator::Scripts::Generate.new.run(x)}
